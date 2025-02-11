// Apply the saved theme settings from local storage
document.querySelector("html").setAttribute("data-layout-mode", localStorage.getItem("layoutMode") || "light_mode");
document.querySelector("html").setAttribute("data-layout-style", localStorage.getItem("layoutStyle") || "default");
document.querySelector("html").setAttribute("data-nav-color", localStorage.getItem("navColor") || "light");

// Create sidebar settings panel using jQuery
let themesettings = `
<div class="sidebar-settings nav-toggle" id="layoutDiv">
    <div class="sidebar-content sticky-sidebar-one">
        <div class="sidebar-header">
            <div class="sidebar-theme-title">
                <h5>Theme Customizer</h5>           
                <p>Customize & Preview in Real Time</p>
            </div>
            <div class="close-sidebar-icon d-flex">
                <a class="sidebar-refresh me-2" onclick="resetData()">&#10227;</a>
                <a class="sidebar-close" href="#">X</a>
            </div>
        </div>
        <div class="sidebar-body p-0">
            <div class="theme-mode mb-0">
                <div class="theme-body-main">
                    <div class="theme-head">
                        <h6>Theme Mode</h6>
                        <p>Enjoy Dark & Light modes.</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 ">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="themes" id="lighttheme" class="check" value="light_mode" checked>
                                        <label for="lighttheme" class="checktoggles">
                                            <img src="assets/img/theme/theme-img-01.jpg" alt="">
                                            <span class="theme-name">Light Mode</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="themes" id="darktheme" class="check" value="dark_mode">
                                        <label for="darktheme" class="checktoggles">
                                            <img src="assets/img/theme/theme-img-02.jpg" alt="">
                                            <span class="theme-name">Dark Mode</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="theme-mode border-0">
                    <div class="theme-head">
                        <h6>Direction</h6>
                        <p>Select the direction for your app.</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="direction" id="ltr" class="check direction" value="ltr" checked>
                                        <label for="ltr" class="checktoggles">
                                            <a href="../template/index.html"><img src="assets/img/theme/theme-img-01.jpg" alt=""></a>
                                            <span class="theme-name">LTR</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="direction" id="rtl" class="check direction" value="rtl">
                                        <label for="rtl" class="checktoggles">
                                            <a href="../template-rtl/index.html" target="_blank"><img src="assets/img/theme/theme-img-03.jpg" alt=""></a>
                                            <span class="theme-name">RTL</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="theme-mode border-0 mb-0">
                    <div class="theme-head">
                        <h6>Layout Mode</h6>
                        <p>Select the primary layout style for your app.</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="layout" id="default_layout" class="check layout-mode" value="default" checked>
                                        <label for="default_layout" class="checktoggles">
                                            <img src="assets/img/theme/theme-img-01.jpg" alt="">
                                            <span class="theme-name">Default</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="layout" id="box_layout" class="check layout-mode" value="box">
                                        <label for="box_layout" class="checktoggles">
                                            <img src="assets/img/theme/theme-img-07.jpg" alt="">
                                            <span class="theme-name">Box</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="layout" id="collapse_layout" class="check layout-mode" value="collapsed">
                                        <label for="collapse_layout" class="checktoggles">
                                            <img src="assets/img/theme/theme-img-05.jpg" alt="">
                                            <span class="theme-name">Collapsed</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="layout" id="horizontal_layout" class="check layout-mode" value="horizontal">
                                        <label for="horizontal_layout" class="checktoggles">
                                            <img src="assets/img/theme/theme-img-06.jpg" alt="">
                                            <span class="theme-name">Horizontal</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="layout" id="modern_layout" class="check layout-mode" value="modern">
                                        <label for="modern_layout" class="checktoggles">
                                            <img src="assets/img/theme/theme-img-04.jpg" alt="">
                                            <span class="theme-name">Modern</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
                <div class="theme-mode">
                    <div class="theme-head">
                        <h6>Navigation Colors</h6>
                        <p>Setup the color for the Navigation</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="nav_color" id="light_color" class="check nav-color" value="light">
                                        <label for="light_color" class="checktoggles">
                                            <span class="theme-name">Light</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="nav_color" id="grey_color" class="check nav-color" value="grey">
                                        <label for="grey_color" class="checktoggles">
                                            <span class="theme-name">Grey</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 ere">
                            <div class="layout-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="status-toggle d-flex align-items-center me-2">
                                        <input type="radio" name="nav_color" id="dark_color" class="check nav-color" value="dark">
                                        <label for="dark_color" class="checktoggles">
                                            <span class="theme-name">Dark</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="sidebar-footer">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="footer-preview-btn">
                            <a href="#" class="btn btn-secondary w-100" id="resetbutton">Reset</a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="footer-reset-btn">
                            <a href="#" class="btn btn-primary w-100">Buy Now</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
`;

document.addEventListener("DOMContentLoaded", function () {
	// Appending theme settings to the main wrapper
	$(".main-wrapper").append(themesettings);

	const themeRadios = document.querySelectorAll('input[name="themes"]');
	const layoutRadios = document.querySelectorAll('input[name="layout"]');
	const colorRadios = document.querySelectorAll('input[name="nav_color"]');
	const resetButton = document.getElementById("resetbutton");

	function setThemeAndLayoutSettings(theme, layout, color) {
		document.documentElement.setAttribute("data-layout-mode", theme);
		document.documentElement.setAttribute("data-layout-style", layout);
		document.documentElement.setAttribute("data-nav-color", color);

		localStorage.setItem("layoutMode", theme);
		localStorage.setItem("layoutStyle", layout);
		localStorage.setItem("navColor", color);
	}

	function handleInputChange() {
		const theme = document.querySelector('input[name="themes"]:checked')?.value;
		const layout = document.querySelector('input[name="layout"]:checked')?.value;
		const color = document.querySelector('input[name="nav_color"]:checked')?.value;

		if (theme && layout && color) {
			setThemeAndLayoutSettings(theme, layout, color);
		} else {
			console.error("One or more settings not found:", {
				theme,
				layout,
				color,
			});
		}
	}

	function resetThemeAndLayoutSettings() {
		setThemeAndLayoutSettings("light_mode", "default", "light");

		// Reset radio buttons
		const lightThemeRadio = document.querySelector('input[name="themes"][value="light_mode"]');
		const defaultLayoutRadio = document.querySelector('input[name="layout"][value="default"]');
		const lightColorRadio = document.querySelector('input[name="nav_color"][value="light"]');

		if (lightThemeRadio) lightThemeRadio.checked = true;
		if (defaultLayoutRadio) defaultLayoutRadio.checked = true;
		if (lightColorRadio) lightColorRadio.checked = true;

		// Remove sidebar background setting if applicable
		localStorage.removeItem("sidebarBg");
	}

	// Initialize radio buttons based on saved settings
	const savedTheme = localStorage.getItem("layoutMode") || "light_mode";
	const savedLayout = localStorage.getItem("layoutStyle") || "default";
	const savedColor = localStorage.getItem("navColor") || "light";

	const themeRadio = document.querySelector(`input[name="themes"][value="${savedTheme}"]`);
	const layoutRadio = document.querySelector(`input[name="layout"][value="${savedLayout}"]`);
	const colorRadio = document.querySelector(`input[name="nav_color"][value="${savedColor}"]`);

	if (themeRadio) themeRadio.checked = true;
	else console.error(`Theme radio button for value "${savedTheme}" not found.`);

	if (layoutRadio) layoutRadio.checked = true;
	else console.error(`Layout radio button for value "${savedLayout}" not found.`);

	if (colorRadio) colorRadio.checked = true;
	else console.error(`Color radio button for value "${savedColor}" not found.`);

	// Adding event listeners
	themeRadios.forEach((radio) => radio.addEventListener("change", handleInputChange));
	layoutRadios.forEach((radio) => radio.addEventListener("change", handleInputChange));
	colorRadios.forEach((radio) => radio.addEventListener("change", handleInputChange));
	if (resetButton) resetButton.addEventListener("click", resetThemeAndLayoutSettings);
});
