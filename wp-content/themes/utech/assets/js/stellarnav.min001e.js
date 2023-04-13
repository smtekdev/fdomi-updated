!(function (u) {
  u.fn.stellarNav = function (n, r, h) {
    (nav = u(this)), (r = u(window).width());
    var f = u.extend(
      {
        theme: "plain",
        breakpoint: 768,
        menuLabel: "Menu",
        sticky: !1,
        position: "static",
        openingSpeed: 250,
        closingDelay: 250,
        showArrows: !0,
        phoneBtn: "",
        phoneLabel: "Call Us",
        locationBtn: "",
        locationLabel: "Location",
        closeBtn: !1,
        closeLabel: "Close",
        mobileMode: !1,
        scrollbarFix: !1,
      },
      n
    );
    return this.each(function () {
      if (
        (("light" != f.theme && "dark" != f.theme) || nav.addClass(f.theme),
        f.breakpoint && (h = f.breakpoint),
        f.menuLabel ? (menuLabel = f.menuLabel) : (menuLabel = ""),
        f.phoneLabel ? (phoneLabel = f.phoneLabel) : (phoneLabel = ""),
        f.locationLabel
          ? (locationLabel = f.locationLabel)
          : (locationLabel = ""),
        f.closeLabel ? (closeLabel = f.closeLabel) : (closeLabel = ""),
        f.phoneBtn && f.locationBtn)
      )
        var n = "third";
      else if (f.phoneBtn || f.locationBtn) n = "half";
      else n = "full";
      if (
        ("right" == f.position || "left" == f.position
          ? nav.prepend(
              '<a href="#" class="menu-toggle"><span class="bars"><span></span><span></span><span></span></span> ' +
                menuLabel +
                "</a>"
            )
          : nav.prepend(
              '<a href="#" class="menu-toggle ' +
                n +
                '"><span class="bars"><span></span><span></span><span></span></span> ' +
                menuLabel +
                "</a>"
            ),
        f.phoneBtn && "right" != f.position && "left" != f.position)
      ) {
        var e =
          '<a href="tel:' +
          f.phoneBtn +
          '" class="call-btn-mobile ' +
          n +
          '"><svg id="icon-phone"></svg> <span>' +
          phoneLabel +
          "</span></a>";
        nav.find("a.menu-toggle").after(e);
      }
      if (f.locationBtn && "right" != f.position && "left" != f.position) {
        e =
          '<a href="' +
          f.locationBtn +
          '" class="location-btn-mobile ' +
          n +
          '" target="_blank"><svg id="icon-location"></svg> <span>' +
          locationLabel +
          "</span></a>";
        nav.find("a.menu-toggle").after(e);
      }
      if (
        (f.sticky &&
          ((navPos = nav.offset().top),
          h <= r &&
            u(window).on("scroll", function () {
              u(window).scrollTop() > navPos
                ? nav.addClass("fixed")
                : nav.removeClass("fixed");
            })),
        "top" == f.position && nav.addClass("top"),
        "left" == f.position || "right" == f.position)
      ) {
        var i =
            '<a href="#" class="close-menu ' +
            n +
            '"><span class="icon-close"></span>' +
            closeLabel +
            "</a>",
          s =
            '<a href="tel:' +
            f.phoneBtn +
            '" class="call-btn-mobile ' +
            n +
            '"><svg id="icon-phone"></svg></a>',
          t =
            '<a href="' +
            f.locationBtn +
            '" class="location-btn-mobile ' +
            n +
            '" target="_blank"><svg id="icon-location"></svg></i></a>';
        nav.find("ul:first").prepend(i),
          f.locationBtn && nav.find("ul:first").prepend(t),
          f.phoneBtn && nav.find("ul:first").prepend(s);
      }
      "right" == f.position && nav.addClass("right"),
        "left" == f.position && nav.addClass("left"),
        f.showArrows || nav.addClass("hide-arrows"),
        f.closeBtn &&
          "right" != f.position &&
          "left" != f.position &&
          nav
            .find("ul:first")
            .append(
              '<li><a href="#" class="close-menu"><span class="icon-close"></span> ' +
                closeLabel +
                "</a></li>"
            ),
        f.scrollbarFix && u("body").addClass("stellarnav-noscroll-x");
      var a = document.getElementById("icon-phone");
      if (a) {
        a.setAttribute("viewBox", "0 0 480 480");
        var l = document.createElementNS("http://www.w3.org/2000/svg", "path");
        l.setAttribute(
          "d",
          "M340.273,275.083l-53.755-53.761c-10.707-10.664-28.438-10.34-39.518,0.744l-27.082,27.076 c-1.711-0.943-3.482-1.928-5.344-2.973c-17.102-9.476-40.509-22.464-65.14-47.113c-24.704-24.701-37.704-48.144-47.209-65.257 c-1.003-1.813-1.964-3.561-2.913-5.221l18.176-18.149l8.936-8.947c11.097-11.1,11.403-28.826,0.721-39.521L73.39,8.194 C62.708-2.486,44.969-2.162,33.872,8.938l-15.15,15.237l0.414,0.411c-5.08,6.482-9.325,13.958-12.484,22.02     C3.74,54.28,1.927,61.603,1.098,68.941C-6,127.785,20.89,181.564,93.866,254.541c100.875,100.868,182.167,93.248,185.674,92.876 c7.638-0.913,14.958-2.738,22.397-5.627c7.992-3.122,15.463-7.361,21.941-12.43l0.331,0.294l15.348-15.029     C350.631,303.527,350.95,285.795,340.273,275.083z"
        ),
          a.appendChild(l);
      }
      var o = document.getElementById("icon-location");
      if (o) {
        o.setAttribute("viewBox", "0 0 480 480");
        var d = document.createElementNS("http://www.w3.org/2000/svg", "path");
        d.setAttribute(
          "d",
          "M322.621,42.825C294.073,14.272,259.619,0,219.268,0c-40.353,0-74.803,14.275-103.353,42.825 c-28.549,28.549-42.825,63-42.825,103.353c0,20.749,3.14,37.782,9.419,51.106l104.21,220.986   c2.856,6.276,7.283,11.225,13.278,14.838c5.996,3.617,12.419,5.428,19.273,5.428c6.852,0,13.278-1.811,19.273-5.428 c5.996-3.613,10.513-8.562,13.559-14.838l103.918-220.986c6.282-13.324,9.424-30.358,9.424-51.106 C365.449,105.825,351.176,71.378,322.621,42.825z M270.942,197.855c-14.273,14.272-31.497,21.411-51.674,21.411 s-37.401-7.139-51.678-21.411c-14.275-14.277-21.414-31.501-21.414-51.678c0-20.175,7.139-37.402,21.414-51.675 c14.277-14.275,31.504-21.414,51.678-21.414c20.177,0,37.401,7.139,51.674,21.414c14.274,14.272,21.413,31.5,21.413,51.675 C292.355,166.352,285.217,183.575,270.942,197.855z"
        ),
          o.appendChild(d);
      }
      u(".menu-toggle, .stellarnav-open").on("click", function (n) {
        n.preventDefault(),
          "left" == f.position || "right" == f.position
            ? (nav.find("ul:first").stop(!0, !0).fadeToggle(f.openingSpeed),
              nav.toggleClass("active"),
              nav.hasClass("active") &&
                nav.hasClass("mobile") &&
                u(document).on("click", function (n) {
                  nav.hasClass("mobile") &&
                    (u(n.target).closest(nav).length ||
                      (nav
                        .find("ul:first")
                        .stop(!0, !0)
                        .fadeOut(f.openingSpeed),
                      nav.removeClass("active")));
                }))
            : (nav.find("ul:first").stop(!0, !0).slideToggle(f.openingSpeed),
              nav.toggleClass("active"));
      }),
        u(".close-menu, .stellarnav-close").on("click", function () {
          nav.removeClass("active"),
            "left" == f.position || "right" == f.position
              ? nav.find("ul:first").stop(!0, !0).fadeToggle(f.openingSpeed)
              : nav
                  .find("ul:first")
                  .stop(!0, !0)
                  .slideUp(f.openingSpeed)
                  .toggleClass("active");
        }),
        nav.find("li a").each(function () {
          0 < u(this).next().length &&
            u(this)
              .parent("li")
              .addClass("has-sub")
              .append(
                '<a class="dd-toggle" href="#"><span class="icon-plus"></span></a>'
              );
        }),
        nav.find("li .dd-toggle").on("click", function (n) {
          n.preventDefault(),
            u(this)
              .parent("li")
              .children("ul")
              .stop(!0, !0)
              .slideToggle(f.openingSpeed),
            u(this).parent("li").toggleClass("open");
        });
      var c = function () {
        nav.find("li").off("mouseenter"), nav.find("li").off("mouseleave");
      };
      parentItems = nav.find("> ul > li");
      function p() {
        window.innerWidth <= h || f.mobileMode
          ? (c(),
            nav.addClass("mobile"),
            nav.removeClass("desktop"),
            !nav.hasClass("active") &&
              nav.find("ul:first").is(":visible") &&
              nav.find("ul:first").hide(),
            nav.find("li.mega").each(function () {
              u(this).find("ul").first().removeAttr("style"),
                u(this).find("ul").first().children().removeAttr("style");
            }))
          : (nav.addClass("desktop"),
            nav.removeClass("mobile"),
            nav.hasClass("active") && nav.removeClass("active"),
            !nav.hasClass("active") &&
              nav.find("ul:first").is(":hidden") &&
              nav.find("ul:first").show(),
            u("li.open").removeClass("open").find("ul:visible").hide(),
            c(),
            u(parentItems).each(function () {
              u(this).hasClass("mega")
                ? (u(this).on("mouseenter", function () {
                    u(this)
                      .find("ul")
                      .first()
                      .stop(!0, !0)
                      /* .slideDown(f.openingSpeed); */
                  }),
                  u(this).on("mouseleave", function () {
                    u(this)
                      .find("ul")
                      .first()
                      .stop(!0, !0)
                      /* .slideUp(f.openingSpeed); */
                  }))
                : (u(this).on("mouseenter", function () {
                    u(this)
                      .children("ul")
                      .stop(!0, !0)
                      /* .slideDown(f.openingSpeed); */
                  }),
                  u(this).on("mouseleave", function () {
                    u(this)
                      .children("ul")
                      .stop(!0, !0)
                      .delay(f.closingDelay)
                      /* .slideUp(f.openingSpeed); */
                  }),
                  u(this)
                    .find("li.has-sub")
                    .on("mouseenter", function () {
                      u(this)
                        .children("ul")
                        .stop(!0, !0)
                        /* .slideDown(f.openingSpeed); */
                    }),
                  u(this)
                    .find("li.has-sub")
                    .on("mouseleave", function () {
                      u(this)
                        .children("ul")
                        .stop(!0, !0)
                        .delay(f.closingDelay)
                        /* .slideUp(f.openingSpeed); */
                    }),
                  u(this)
                    .find("li")
                    .on("mouseenter", function () {
                      u(this).addClass("hover");
                    }),
                  u(this)
                    .find("li")
                    .on("mouseleave", function () {
                      u(this).removeClass("hover");
                    }));
            }),
            (navWidth = 0),
            u(parentItems).each(function () {
              (navWidth += u(this)[0].getBoundingClientRect().width),
                (navWidth = Math.round(navWidth)),
                u(this).hasClass("mega") &&
                  (u(this)
                    .find("ul")
                    .first()
                    .css({ left: 0, right: 0, margin: "0px auto" }),
                  (numCols = u(this).attr("data-columns")),
                  2 == numCols
                    ? u(this).find("li.has-sub").width("50%")
                    : 3 == numCols
                    ? u(this).find("ul").first().children().width("33.33%")
                    : 4 == numCols
                    ? u(this).find("ul").first().children().width("25%")
                    : 5 == numCols
                    ? u(this).find("ul").first().children().width("20%")
                    : 6 == numCols
                    ? u(this).find("ul").first().children().width("16.66%")
                    : 7 == numCols
                    ? u(this).find("ul").first().children().width("14.28%")
                    : 8 == numCols
                    ? u(this).find("ul").first().children().width("12.5%")
                    : u(this).find("ul").first().children().width("25%"));
            }),
            parentItems.hasClass("mega") &&
              nav.find("li.mega > ul").css({ "max-width": navWidth }));
      }
      p(),
        u(window).on("resize", function () {
          p();
        });
    });
  };
})(jQuery);
