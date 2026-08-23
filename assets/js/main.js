(function () {
    "use strict";

    var navToggle = document.getElementById("navToggle");
    var mainNav = document.getElementById("mainNav");
    if (navToggle && mainNav) {
        navToggle.addEventListener("click", function () {
            var isOpen = mainNav.classList.toggle("is-open");
            navToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
        });
    }

    var backToTop = document.getElementById("backToTop");
    if (backToTop) {
        window.addEventListener("scroll", function () {
            backToTop.classList.toggle("is-visible", window.scrollY > 400);
        });
        backToTop.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    var newsletterForm = document.querySelector(".newsletter__form");
    if (newsletterForm) {
        newsletterForm.addEventListener("submit", function (e) {
            e.preventDefault();
            var input = newsletterForm.querySelector("input");
            if (input && input.value) {
                input.value = "";
                input.placeholder = input.getAttribute("data-success-label") || "Subscribed successfully, thank you!";
            }
        });
    }

    /* Listing page: category pills + live search filter the department
       items together (both conditions must match). Works for both the
       card-grid layout and the grouped-directory layout — either one
       just needs to mark its items with [data-searchable] and, if items
       are clustered into sections, wrap each cluster with [data-group]. */
    var grid = document.querySelector("[data-dept-grid]");
    if (grid) {
        var cards = Array.prototype.slice.call(grid.querySelectorAll("[data-searchable]"));
        var groups = Array.prototype.slice.call(grid.querySelectorAll("[data-group]"));
        var pills = Array.prototype.slice.call(document.querySelectorAll(".filter-pill"));
        var searchInput = document.getElementById("deptSearch");
        var noResults = document.querySelector(".no-results");
        var countEl = document.querySelector(".filter-count");
        var activeCategory = "all";

        var applyFilters = function () {
            var query = (searchInput && searchInput.value.trim().toLowerCase()) || "";
            var visible = 0;
            cards.forEach(function (card) {
                var matchesCategory = activeCategory === "all" || card.getAttribute("data-category") === activeCategory;
                var matchesQuery = !query || card.getAttribute("data-search").indexOf(query) !== -1;
                var show = matchesCategory && matchesQuery;
                card.classList.toggle("is-hidden", !show);
                if (show) visible++;
            });
            groups.forEach(function (group) {
                var hasVisible = !!group.querySelector("[data-searchable]:not(.is-hidden)");
                group.classList.toggle("is-hidden", !hasVisible);
            });
            if (noResults) noResults.classList.toggle("is-visible", visible === 0);
            if (countEl) {
                var template = countEl.getAttribute("data-template") || "{n} / {total}";
                countEl.textContent = template.replace("{n}", visible).replace("{total}", cards.length);
            }
        };

        pills.forEach(function (pill) {
            pill.addEventListener("click", function () {
                pills.forEach(function (p) { p.classList.remove("is-active"); });
                pill.classList.add("is-active");
                activeCategory = pill.getAttribute("data-category");
                applyFilters();
            });
        });

        if (searchInput) {
            searchInput.addEventListener("input", applyFilters);
        }

        applyFilters();
    }

    /* Detail page: long responsibility lists start collapsed to a fixed
       height (with a fade) behind one "show all" button, instead of
       forcing a click-through per item or per page. */
    var listWrap = document.querySelector("[data-collapsible]");
    if (listWrap) {
        var showMoreBtn = document.querySelector(".show-more-btn");
        var showMoreLabel = showMoreBtn && showMoreBtn.querySelector("span");
        if (showMoreBtn) {
            showMoreBtn.addEventListener("click", function () {
                var collapsed = listWrap.classList.toggle("is-collapsed");
                if (showMoreLabel) {
                    showMoreLabel.textContent = collapsed ? showMoreBtn.dataset.showLabel : showMoreBtn.dataset.hideLabel;
                }
                if (collapsed) {
                    listWrap.scrollIntoView({ behavior: "smooth", block: "start" });
                }
            });
        }
    }
})();
