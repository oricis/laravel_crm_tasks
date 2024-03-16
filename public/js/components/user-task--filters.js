'use strict';
loaded('js/components/user-task--filters.js');

////////////////////////////////////////////////////////////////////////

const timeFilterOptionsButton = qs('button#timeFiltersButton');
const timeFilterOptions = qsa('#timeFilters li');
timeFilterOptions.forEach(element => {
    element.addEventListener('click', function (ev) {
        timeFilterOptionsButton.textContent = element.textContent;
    });
});
