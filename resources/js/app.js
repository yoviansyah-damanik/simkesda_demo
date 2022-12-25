require("./bootstrap");

// IMPORT
var $ = require("jquery");
var bootstrap = require("bootstrap");
require("@popperjs/core");
require("select2");
require("trix");

const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-tooltip="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

const offcanvasElementList = document.querySelectorAll(".offcanvas");
const offcanvasList = [...offcanvasElementList].map(
    (offcanvasEl) => new bootstrap.Offcanvas(offcanvasEl)
);

const myCarouselElement = document.querySelector(".carousel");
const carousel = new bootstrap.Carousel(myCarouselElement, {
    interval: 5000,
});
