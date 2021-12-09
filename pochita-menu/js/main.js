var DEFAULT_SECTION_VISIBLE = 'visible';
var DEFAULT_SECTION_HIDDEN = 'hidden';
var SECTION_ELEMENT = '.section';
var DEFAULT_NAV_VISIBLE = 'active';
var DEFAULT_NAV_HIDDEN = 'inactive';
var NAV_ELEMENT = '.nav-item';
var Controller = /** @class */ (function () {
    function Controller(sectionQuery, navigatorQuery) {
        this._section = Array.from(document.querySelectorAll(SECTION_ELEMENT));
        this._navigator = Array.from(document.querySelectorAll(NAV_ELEMENT));
        this._sectionQuery = document.querySelector(sectionQuery);
        this._navigatorQuery = document.querySelector(navigatorQuery);
        this._doLoop();
    }
    Controller.prototype._doLoop = function () {
        var _this = this;
        var _a, _b;
        (_a = this._section) === null || _a === void 0 ? void 0 : _a.forEach(function (item) { _this._toggleSections(item); });
        (_b = this._navigator) === null || _b === void 0 ? void 0 : _b.forEach(function (item) { _this._toggleActive(item); });
    };
    Controller.prototype._toggleSections = function (item) {
        var _a, _b, _c;
        (_a = item === null || item === void 0 ? void 0 : item.classList) === null || _a === void 0 ? void 0 : _a.replace(DEFAULT_SECTION_VISIBLE, DEFAULT_SECTION_HIDDEN);
        (_c = (_b = this._sectionQuery) === null || _b === void 0 ? void 0 : _b.classList) === null || _c === void 0 ? void 0 : _c.replace(DEFAULT_SECTION_HIDDEN, DEFAULT_SECTION_VISIBLE);
    };
    Controller.prototype._toggleActive = function (item) {
        var _a, _b, _c;
        (_a = item === null || item === void 0 ? void 0 : item.classList) === null || _a === void 0 ? void 0 : _a.replace(DEFAULT_NAV_VISIBLE, DEFAULT_NAV_HIDDEN);
        (_c = (_b = this._navigatorQuery) === null || _b === void 0 ? void 0 : _b.classList) === null || _c === void 0 ? void 0 : _c.replace(DEFAULT_NAV_HIDDEN, DEFAULT_NAV_VISIBLE);
    };
    return Controller;
}());
var main = document.querySelector("#main-toggle");
var humanizer = document.querySelector("#humanizer-toggle");
var weapon = document.querySelector("#weapon-toggle");
var triggerbot = document.querySelector("#triggerbot-toggle");
var sound = document.querySelector("#sound-toggle");
var tf2 = document.querySelector("#tf2-toggle");
main.onclick = function () {
    new Controller('#main', '#main-toggle');
};
humanizer.onclick = function () {
    new Controller('#humanizer', '#humanizer-toggle');
};
weapon.onclick = function () {
    new Controller('#weapon', '#weapon-toggle');
};
triggerbot.onclick = function () {
    new Controller('#triggerbot', '#triggerbot-toggle');
};
sound.onclick = function () {
    new Controller('#sound', '#sound-toggle');
};
tf2.onclick = function () {
    new Controller('#tf2', '#tf2-toggle');
};
