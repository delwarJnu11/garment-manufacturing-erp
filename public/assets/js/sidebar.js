// document.addEventListener("DOMContentLoaded", function () {
//     document.querySelectorAll(".submenu").forEach(function (submenu) {
//         let submenuLinks = submenu.querySelectorAll("ul li a");

//         // Check if any submenu link is active
//         let isSubmenuActive = Array.from(submenuLinks).some((link) =>
//             link.classList.contains("active")
//         );

//         if (isSubmenuActive) {
//             submenu.classList.add("active");
//             let submenuList = submenu.querySelector("ul");
//             if (submenuList) {
//                 submenuList.style.display = "block";
//             }
//         }

//         // Toggle submenu on click
//         submenu.querySelector("a").addEventListener("click", function (event) {
//             event.preventDefault();

//             let submenuList = submenu.querySelector("ul");
//             if (submenuList) {
//                 submenu.classList.toggle("active");
//                 submenuList.style.display =
//                     submenuList.style.display === "block" ? "none" : "block";
//             }
//         });
//     });
// });

// document.addEventListener("DOMContentLoaded", function () {
//     feather.replace();
//     $("ul li a").on("click", function () {
//         $(this).toggleClass("active");
//         $(this).find("ul").slideToggle();
//     });
// });
