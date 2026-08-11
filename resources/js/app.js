import './bootstrap';

const appData = window.KOTA_JAIL || {};
const stops = appData.stops || [];
const profiles = appData.plannerProfiles || [];
const storageKeys = {
    completed: 'kotaJail.completedStops',
    lastVisited: 'kotaJail.lastVisitedStop',
    preferences: 'kotaJail.preferences',
};

const $ = (selector, root = document) => root.querySelector(selector);
const $$ = (selector, root = document) => Array.from(root.querySelectorAll(selector));

function readJson(key, fallback) {
    try {
        return JSON.parse(localStorage.getItem(key)) ?? fallback;
    } catch {
        return fallback;
    }
}

function writeJson(key, value) {
    try {
        localStorage.setItem(key, JSON.stringify(value));
    } catch {
        showToast('Your browser blocked local storage for this session.');
    }
}

function getCompleted() {
    return readJson(storageKeys.completed, []);
}

function setCompleted(slugs) {
    writeJson(storageKeys.completed, Array.from(new Set(slugs)));
}

function isCompleted(slug) {
    return getCompleted().includes(slug);
}

function showToast(message) {
    const toast = $('[data-toast]');
    if (!toast) return;

    toast.textContent = message;
    toast.classList.remove('hidden');
    clearTimeout(showToast.timeout);
    showToast.timeout = setTimeout(() => toast.classList.add('hidden'), 3200);
}

function updateTourProgress() {
    const completed = getCompleted();
    const total = stops.length || 1;
    const percent = Math.round((completed.length / total) * 100);
    const nextStop = stops.find((stop) => !completed.includes(stop.slug)) || stops[0];
    const remainingStops = stops.filter((stop) => !completed.includes(stop.slug));
    const remainingMinutes = remainingStops.reduce((sum, stop) => sum + (parseInt(stop.duration, 10) || 0), 0);

    $$('[data-progress-card]').forEach((card) => {
        $('[data-progress-percent]', card).textContent = `${percent}%`;
        $('[data-progress-bar]', card).style.width = `${percent}%`;
        $('[data-progress-completed]', card).textContent = completed.length;
        $('[data-progress-remaining]', card).textContent = Math.max(total - completed.length, 0);
        $('[data-progress-time]', card).textContent = `${remainingMinutes || 0} min`;
        $('[data-progress-next]', card).textContent = nextStop ? nextStop.title : 'Tour complete';
    });

    $$('[data-resume-tour]').forEach((link) => {
        if (nextStop && link.tagName === 'A') {
            link.href = nextStop.url;
        }
    });

    $$('[data-location-card], [data-map-marker]').forEach((element) => {
        const slug = element.dataset.stopSlug;
        element.classList.toggle('is-completed', completed.includes(slug));
    });

    $$('[data-complete-toggle]').forEach((button) => {
        const slug = button.dataset.stopSlug;
        const done = completed.includes(slug);
        button.classList.toggle('is-completed', done);
        const short = button.dataset.mobilePanelComplete !== undefined;
        button.textContent = done ? (short ? 'Completed' : 'Completed') : (short ? 'Complete' : 'Mark Completed');
    });

    const mobileProgress = $('[data-mobile-progress]');
    if (mobileProgress) {
        mobileProgress.textContent = percent > 0 ? `Tour ${percent}%` : 'Tour';
    }
}

function toggleStopCompletion(slug) {
    if (!slug) return;

    const completed = getCompleted();
    const next = completed.includes(slug)
        ? completed.filter((item) => item !== slug)
        : [...completed, slug];

    setCompleted(next);
    writeJson(storageKeys.lastVisited, slug);
    updateTourProgress();
    showToast(next.includes(slug) ? 'Stop marked as completed.' : 'Stop completion removed.');
}

function initHeader() {
    const header = $('[data-site-header]');
    if (!header) return;

    const syncHeader = () => {
        header.classList.toggle('is-scrolled', window.scrollY > 24 || !document.body.classList.contains('home-page'));
    };

    syncHeader();
    window.addEventListener('scroll', syncHeader, { passive: true });
}

function initMobileMenu() {
    const drawer = $('[data-mobile-drawer]');
    const overlay = $('[data-mobile-overlay]');
    const toggles = $$('[data-mobile-toggle]');
    const closeButtons = $$('[data-mobile-close]');
    if (!drawer || !overlay) return;

    const setOpen = (open) => {
        drawer.classList.toggle('is-open', open);
        drawer.setAttribute('aria-hidden', String(!open));
        overlay.classList.toggle('hidden', !open);
        document.body.style.overflow = open ? 'hidden' : '';
        toggles.forEach((toggle) => toggle.setAttribute('aria-expanded', String(open)));
    };

    toggles.forEach((toggle) => toggle.addEventListener('click', () => setOpen(true)));
    closeButtons.forEach((button) => button.addEventListener('click', () => setOpen(false)));
    overlay.addEventListener('click', () => setOpen(false));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') setOpen(false);
    });
}

function initBackToTop() {
    const button = $('[data-back-to-top]');
    if (!button) return;

    const sync = () => button.classList.toggle('hidden', window.scrollY < 500);
    sync();
    window.addEventListener('scroll', sync, { passive: true });
    button.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

function initProgressControls() {
    document.addEventListener('click', (event) => {
        const button = event.target.closest('[data-complete-toggle]');
        if (!button) return;

        event.preventDefault();
        toggleStopCompletion(button.dataset.stopSlug);
    });

    $$('[data-reset-progress]').forEach((button) => {
        button.addEventListener('click', () => {
            setCompleted([]);
            writeJson(storageKeys.lastVisited, null);
            updateTourProgress();
            showToast('Tour progress has been reset.');
        });
    });

    updateTourProgress();
}

function initFilters() {
    $$('[data-filter-scope]').forEach((scope) => {
        const search = $('[data-search-input]', scope);
        const category = $('[data-category-filter]', scope);
        const resultCount = $('[data-result-count]', scope);
        const empty = $('[data-empty-state]', scope);
        const grid = $('[data-results-grid]', scope);

        const getCards = () => {
            if (scope.dataset.filterType === 'gallery') return $$('[data-gallery-card]', scope);
            return $$('[data-location-card]', scope);
        };

        const apply = () => {
            const term = (search?.value || '').trim().toLowerCase();
            const categoryValue = (category?.value || 'all').toLowerCase();
            let visible = 0;

            getCards().forEach((card) => {
                const text = [
                    card.dataset.stopTitle,
                    card.dataset.stopCategory,
                    card.dataset.stopTags,
                    card.dataset.galleryTitle,
                    card.dataset.galleryCategory,
                    card.textContent,
                ].filter(Boolean).join(' ').toLowerCase();
                const cardCategory = (card.dataset.stopCategory || card.dataset.galleryCategory || '').toLowerCase();
                const tags = (card.dataset.stopTags || '').toLowerCase();
                const termMatch = !term || text.includes(term);
                const categoryMatch = categoryValue === 'all' || cardCategory === categoryValue || tags.includes(categoryValue);
                const show = termMatch && categoryMatch;

                card.classList.toggle('is-hidden', !show);
                if (card.parentElement && scope.dataset.filterType === 'gallery') {
                    card.parentElement.classList.toggle('hidden', !show);
                }
                if (show) visible += 1;
            });

            if (resultCount) resultCount.textContent = visible;
            empty?.classList.toggle('hidden', visible !== 0);
        };

        [search, category].filter(Boolean).forEach((input) => input.addEventListener('input', apply));
        $('[data-clear-filters]', scope)?.addEventListener('click', () => {
            if (search) search.value = '';
            if (category) category.value = 'all';
            apply();
        });

        $$('[data-view-mode]', scope).forEach((button) => {
            button.addEventListener('click', () => {
                $$('[data-view-mode]', scope).forEach((item) => item.classList.remove('is-active'));
                button.classList.add('is-active');
                if (!grid || scope.dataset.filterType !== 'locations') return;
                const list = button.dataset.viewMode === 'list';
                grid.classList.toggle('md:grid-cols-2', !list);
                grid.classList.toggle('xl:grid-cols-3', !list);
                grid.classList.toggle('grid-cols-1', list);
            });
        });

        apply();
    });
}

function updateImageCredit(target, item) {
    if (!target) return;

    target.textContent = '';

    if (!item?.image_credit) {
        target.classList.add('hidden');
        return;
    }

    target.classList.remove('hidden');

    if (item.image_source_url) {
        const link = document.createElement('a');
        link.href = item.image_source_url;
        link.target = '_blank';
        link.rel = 'noopener noreferrer';
        link.textContent = item.image_credit;
        target.append(link);
        return;
    }

    target.append(document.createTextNode(item.image_credit));
}

function initMapPage() {
    const page = $('[data-map-page]');
    if (!page) return;

    const canvas = $('[data-map-canvas]', page);
    const list = $('[data-map-list]', page);
    const sheet = $('[data-mobile-stop-sheet]', page);
    const panel = $('[data-stop-panel]', page);

    const selectStop = (slug) => {
        const stop = stops.find((item) => item.slug === slug) || stops[0];
        if (!stop) return;

        $$('[data-map-marker]', page).forEach((marker) => marker.classList.toggle('is-selected', marker.dataset.stopSlug === slug));

        if (panel) {
            const panelImage = $('[data-panel-image]', panel);
            if (panelImage) {
                panelImage.src = stop.image_url;
                panelImage.alt = stop.alt;
                panelImage.style.objectPosition = stop.image_position || 'center';
                if (stop.image_width) panelImage.setAttribute('width', stop.image_width);
                if (stop.image_height) panelImage.setAttribute('height', stop.image_height);
            }
            updateImageCredit($('[data-panel-credit]', panel), stop);
            $('[data-panel-number]', panel).textContent = stop.number;
            $('[data-panel-category]', panel).textContent = stop.category;
            $('[data-panel-title]', panel).textContent = stop.title;
            $('[data-panel-excerpt]', panel).textContent = stop.excerpt;
            $('[data-panel-duration]', panel).textContent = stop.duration;
            $('[data-panel-link]', panel).href = stop.url;
            $('[data-panel-complete]', panel).dataset.stopSlug = stop.slug;
            $('[data-nearby-suggestion]', panel).textContent = `Continue from ${stop.title}, then follow the next incomplete marker.`;
        }

        if (sheet) {
            $('[data-mobile-panel-title]', sheet).textContent = stop.title;
            $('[data-mobile-panel-excerpt]', sheet).textContent = stop.excerpt;
            $('[data-mobile-panel-link]', sheet).href = stop.url;
            $('[data-mobile-panel-complete]', sheet).dataset.stopSlug = stop.slug;
            sheet.classList.remove('hidden');
        }

        updateTourProgress();
    };

    $$('[data-map-marker]', page).forEach((marker) => {
        marker.addEventListener('click', () => selectStop(marker.dataset.stopSlug));
    });

    $$('[data-map-toggle]', page).forEach((button) => {
        button.addEventListener('click', () => {
            $$('[data-map-toggle]', page).forEach((item) => item.classList.remove('is-active'));
            button.classList.add('is-active');
            const listMode = button.dataset.mapToggle === 'list';
            canvas.classList.toggle('hidden', listMode);
            list.classList.toggle('hidden', !listMode);
        });
    });

    const applyMapFilters = () => {
        const category = ($('[data-map-category]', page)?.value || 'all').toLowerCase();
        const route = ($('[data-map-route]', page)?.value || 'all').toLowerCase();
        $$('[data-map-marker]', page).forEach((marker) => {
            const categoryMatch = category === 'all' || marker.dataset.stopCategory === category;
            const routeMatch = route === 'all' || marker.dataset.stopRoutes.includes(route);
            marker.classList.toggle('is-hidden', !(categoryMatch && routeMatch));
        });
        $$('[data-location-card]', page).forEach((card) => {
            const categoryMatch = category === 'all' || card.dataset.stopCategory === category || card.dataset.stopTags.includes(category);
            const routeMatch = route === 'all' || card.dataset.stopRoutes.includes(route);
            card.classList.toggle('is-hidden', !(categoryMatch && routeMatch));
        });
    };

    $('[data-map-category]', page)?.addEventListener('change', applyMapFilters);
    $('[data-map-route]', page)?.addEventListener('change', applyMapFilters);
    $('[data-reset-map]', page)?.addEventListener('click', () => {
        $('[data-map-category]', page).value = 'all';
        $('[data-map-route]', page).value = 'all';
        applyMapFilters();
        selectStop(stops[0]?.slug);
        showToast('Map filters reset.');
    });

    $('[data-close-stop-sheet]', page)?.addEventListener('click', () => sheet?.classList.add('hidden'));
    selectStop(stops[0]?.slug);
}

function initGeolocation() {
    $$('[data-current-location]').forEach((button) => {
        button.addEventListener('click', () => {
            if (!navigator.geolocation) {
                showToast('Location is not available in this browser.');
                return;
            }

            showToast('Requesting your location for nearby stop guidance.');
            navigator.geolocation.getCurrentPosition(
                () => showToast('Location received. Use the nearest visible stop as your next checkpoint.'),
                () => showToast('Location permission was denied or unavailable.')
            );
        });
    });
}

function initAccordions() {
    $$('[data-accordion-trigger]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const panel = trigger.parentElement.querySelector('[data-accordion-panel]');
            const open = panel.classList.toggle('hidden') === false;
            trigger.setAttribute('aria-expanded', String(open));
            $('svg', trigger)?.classList.toggle('rotate-90', open);
        });
    });
}

function initLightbox() {
    const lightbox = $('[data-lightbox]');
    if (!lightbox) return;

    const image = $('[data-lightbox-image]', lightbox);
    const title = $('[data-lightbox-title]', lightbox);
    const category = $('[data-lightbox-category]', lightbox);
    const caption = $('[data-lightbox-caption]', lightbox);
    const credit = $('[data-lightbox-credit]', lightbox);
    let activeIndex = 0;
    let activeCards = [];

    const visibleCards = () => $$('[data-gallery-card]').filter((card) => !card.classList.contains('is-hidden'));

    const open = (card) => {
        activeCards = visibleCards();
        activeIndex = activeCards.indexOf(card);
        update();
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    const close = () => {
        lightbox.classList.add('hidden');
        document.body.style.overflow = '';
    };

    const update = () => {
        const card = activeCards[activeIndex];
        if (!card) return;
        const img = $('img', card);
        image.src = img.src;
        image.alt = img.alt;
        title.textContent = $('h3', card)?.textContent || 'Gallery image';
        category.textContent = card.dataset.galleryCategory || 'Gallery';
        const visibleCaption = card.querySelector('figcaption p:not(.image-credit)')?.textContent || '';
        caption.textContent = visibleCaption;
        if (credit) {
            credit.textContent = card.dataset.galleryCredit || '';
            credit.classList.toggle('hidden', !card.dataset.galleryCredit);
        }
    };

    const move = (direction) => {
        activeCards = visibleCards();
        activeIndex = (activeIndex + direction + activeCards.length) % activeCards.length;
        update();
    };

    document.addEventListener('click', (event) => {
        const opener = event.target.closest('[data-lightbox-open]');
        if (opener) open(opener.closest('[data-gallery-card]'));
    });
    $('[data-lightbox-close]', lightbox)?.addEventListener('click', close);
    $('[data-lightbox-prev]', lightbox)?.addEventListener('click', () => move(-1));
    $('[data-lightbox-next]', lightbox)?.addEventListener('click', () => move(1));
    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) close();
    });
    document.addEventListener('keydown', (event) => {
        if (lightbox.classList.contains('hidden')) return;
        if (event.key === 'Escape') close();
        if (event.key === 'ArrowLeft') move(-1);
        if (event.key === 'ArrowRight') move(1);
    });
}

function initPlanner() {
    const planner = $('[data-visit-planner]');
    if (!planner || !profiles.length) return;

    const fields = $$('[data-planner-field]', planner);
    const title = $('[data-planner-title]', planner);
    const route = $('[data-planner-route]', planner);
    const description = $('[data-planner-description]', planner);
    const stopsContainer = $('[data-planner-stops]', planner);

    const chooseProfile = () => {
        const values = Object.fromEntries(fields.map((field) => [field.name, field.value]));
        let profileName = 'Best for first-time visitors';

        if (values.accessibility === 'accessible' || values.accessibility === 'rest') profileName = 'Best accessible route';
        else if (values.interest === 'architecture') profileName = 'Best for architecture enthusiasts';
        else if (values.interest === 'art') profileName = 'Best for art enthusiasts';
        else if (values.interest === 'families' || values.group === 'family') profileName = 'Best for families';
        else if (values.interest === 'short' || values.time === '30') profileName = 'Best short route';

        const profile = profiles.find((item) => item.name === profileName) || profiles[0];
        title.textContent = profile.name;
        route.textContent = profile.route;
        description.textContent = profile.description;
        stopsContainer.innerHTML = profile.stops.map((stop) => `<span class="rounded-2xl bg-paper-white/5 px-4 py-3 text-sm font-semibold text-paper-white">${stop}</span>`).join('');
    };

    fields.forEach((field) => field.addEventListener('change', chooseProfile));
    chooseProfile();
}

function initTourPreferences() {
    const form = $('[data-tour-preferences]');
    if (!form) return;

    const fields = $$('input, select', form).filter((field) => field.name);
    const saved = readJson(storageKeys.preferences, {});

    fields.forEach((field) => {
        if (saved[field.name] === undefined) return;
        if (field.type === 'checkbox') field.checked = Boolean(saved[field.name]);
        else if (field.type === 'radio') field.checked = saved[field.name] === field.value;
        else field.value = saved[field.name];
    });

    const save = () => {
        const values = {};
        fields.forEach((field) => {
            if (field.type === 'checkbox') values[field.name] = field.checked;
            else if (field.type === 'radio') {
                if (field.checked) values[field.name] = field.value;
            } else values[field.name] = field.value;
        });
        writeJson(storageKeys.preferences, values);
    };

    fields.forEach((field) => field.addEventListener('change', save));
    $$('[data-save-preferences]').forEach((button) => button.addEventListener('click', () => {
        save();
        showToast('Tour preferences saved on this device.');
    }));
}

function initShareLinks() {
    $$('[data-share-link]').forEach((button) => {
        button.addEventListener('click', async () => {
            const payload = {
                title: document.title,
                url: window.location.href,
            };

            try {
                if (navigator.share) {
                    await navigator.share(payload);
                    return;
                }
                await navigator.clipboard.writeText(payload.url);
                showToast('Link copied to clipboard.');
            } catch {
                showToast('Sharing was cancelled.');
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initMobileMenu();
    initBackToTop();
    initProgressControls();
    initFilters();
    initMapPage();
    initGeolocation();
    initAccordions();
    initLightbox();
    initPlanner();
    initTourPreferences();
    initShareLinks();
});
