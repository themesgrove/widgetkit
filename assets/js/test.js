// Utility function for typeof checking
function _typeof(obj) {
    return _typeof = 
        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator 
        ? function(obj) { return typeof obj; } 
        : function(obj) { 
            return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype 
                ? "symbol" 
                : typeof obj; 
          },
        _typeof(obj);
}

// Refresh ScrollTrigger when lazy-loaded images complete loading
function aaerefreshOnImageLoad() {
    document.querySelectorAll('img[loading="lazy"]').forEach(function(image) {
        if (!image.complete) {
            image.addEventListener("load", function() {
                ScrollTrigger.refresh();
            });
        }
    });
}

(function($) {
    $(window).on("elementor/frontend/init", function() {
        var windowWidth = $(window).width();
        
        // Check if elementorFrontend exists
        if ("object" === (typeof elementorFrontend === "undefined" ? "undefined" : _typeof(elementorFrontend))) {
            var smoothConfig = WCF_ADDONS_JS.smoothScroller;
            var activeBreakpoints = elementorFrontend.config.responsive.activeBreakpoints;
            var BaseHandler = elementorModules.frontend.handlers.Base;
            var smoothValue = 1.35;
            var enableMobile = false;
            var mediaQuery = "min-width: 768px";
            var isEditMode = false;
            
            // Get smooth scroll configuration
            if (smoothConfig !== null) {
                smoothValue = smoothConfig.smooth;
                enableMobile = smoothConfig.mobile === "on";
                mediaQuery = smoothConfig.media !== null && smoothConfig.media !== undefined 
                    ? smoothConfig.media 
                    : mediaQuery;
            }
            
            isEditMode = typeof elementor !== "undefined" && elementorFrontend && elementorFrontend.isEditMode();
            
            // Register GSAP plugins if available
            if (window.ScrollTrigger) {
                gsap.registerPlugin(ScrollTrigger);
            }
            if (window.ScrollToPlugin) {
                gsap.registerPlugin(ScrollToPlugin);
            }
            
            // Skip smoother initialization in edit mode if disabled
            if ((isEditMode && smoothConfig && smoothConfig.disableMode === "true") || 
                (smoothConfig && smoothConfig.disableMode === 1 && isEditMode)) {
                // Do nothing
            } 
            // Initialize ScrollSmoother if available
            else if (typeof ScrollSmoother === "function" && "object" === (typeof gsap === "undefined" ? "undefined" : _typeof(gsap))) {
                window.aaeinitSmoother = function() {
                    var wcfAddons = WCF_ADDONS_JS;
                    
                    // Kill existing smoother
                    if (window.wcf_smoother) {
                        window.wcf_smoother.kill();
                    }
                    
                    // Check if page smoother is disabled
                    if (wcfAddons && wcfAddons.page_smoother && wcfAddons.page_smoother.disable && 
                        WCF_ADDONS_JS.page_smoother.disable === 1) {
                        return;
                    }
                    
                    // Create new smoother
                    window.wcf_smoother = ScrollSmoother.create({
                        smooth: smoothValue,
                        effects: true,
                        smoothTouch: 0.1,
                        normalizeScroll: true,
                        ignoreMobileResize: false
                    });
                };
                
                var smootherMedia = gsap.matchMedia();
                
                // Initialize smoother based on mobile settings
                if (enableMobile) {
                    window.aaeinitSmoother(smoothValue);
                } else {
                    smootherMedia.add("(" + mediaQuery + ")", function() {
                        window.aaeinitSmoother(smoothValue);
                    });
                }
            }
            
            // GSAP animations setup
            if ("object" === (typeof gsap === "undefined" ? "undefined" : _typeof(gsap))) {
                var media = gsap.matchMedia();
                
                // Register ScrollTrigger if available
                if ("object" === (typeof ScrollTrigger === "undefined" ? "undefined" : _typeof(ScrollTrigger))) {
                    gsap.registerPlugin(ScrollTrigger);
                }
                
                // ======================
                // WIDGET ANIMATION HANDLER
                // ======================
                var WidgetAnimationHandler = BaseHandler.extend({
                    bindEvents: function() {
                        this.run();
                    },
                    
                    onElementChange: function(propertyName, value) {
                        // Handle element changes
                    },
                    
                    run: function() {
                        var self = this;
                        
                        // Run all animation methods
                        this.fade_animation();
                        
                        if (this.getElementType() === "widget") {
                            if (this.isEdit) {
                                this.text_animation();
                            } else {
                                // Wait for fonts to load before text animation
                                document.fonts.ready.then(function() {
                                    self.text_animation();
                                });
                            }
                            
                            this.image_animation();
                        }
                        
                        this.button_move_animation();
                    },
                    
                    // ======================
                    // TEXT ANIMATIONS
                    // ======================
                    text_animation: function() {
                        var self = this;
                        
                        // Skip if in edit mode and not enabled for editor
                        if (this.isEdit && !this.getElementSettings("wcf_text_animation_editor")) {
                            return;
                        }
                        
                        var breakpointCondition = "all";
                        
                        // Set breakpoint condition
                        if (this.getElementSettings("text_animation_breakpoint")) {
                            var breakpointValue = activeBreakpoints[this.getElementSettings("text_animation_breakpoint")].value;
                            var minMax = this.getElementSettings("text_breakpoint_min_max");
                            breakpointCondition = minMax === "min" 
                                ? "min-width: " + breakpointValue + "px" 
                                : "max-width: " + breakpointValue + "px";
                        }
                        
                        // CHAR/WORD ANIMATION
                        if (this.getElementSettings("wcf_text_animation") === "char" || 
                            this.getElementSettings("wcf_text_animation") === "word") {
                            
                            var duration = this.getElementSettings("text_duration");
                            var stagger = this.getElementSettings("text_stagger");
                            var translateX = this.getElementSettings("text_translate_x");
                            var translateY = this.getElementSettings("text_translate_y");
                            var onScroll = this.getElementSettings("text_on_scroll");
                            var delay = this.getElementSettings("text_delay");
                            var scrubSetting = this.getElementSettings("spin_text_scrub");
                            var childrenCount = this.findElement(".elementor-widget-container").children().length;
                            var targetElement = $(this.findElement(".elementor-widget-container").children()[childrenCount - 1]);
                            
                            // Parse scrub setting
                            scrubSetting = typeof scrubSetting === "number" 
                                ? this.getElementSettings("wcf_pin_scrub_number") 
                                : scrubSetting === "yes";
                            
                            var animationParams = {
                                duration: duration,
                                autoAlpha: 0,
                                delay: delay,
                                stagger: stagger
                            };
                            
                            if (translateX) animationParams.x = translateX;
                            if (translateY) animationParams.y = translateY;
                            
                            if (onScroll) {
                                animationParams.scrollTrigger = {
                                    trigger: targetElement,
                                    start: "top 80%",
                                    scrub: scrubSetting
                                };
                            }
                            
                            // Wait for fonts to load
                            document.fonts.ready.then(function() {
                                var splitText = new SplitText(targetElement[0], {
                                    type: "chars, words"
                                });
                                
                                var elements = splitText.chars;
                                if (self.getElementSettings("wcf_text_animation") === "word") {
                                    elements = splitText.words;
                                }
                                
                                if (breakpointCondition === "all") {
                                    gsap.from(elements, animationParams);
                                } else {
                                    media.add("(" + breakpointCondition + ")", function() {
                                        gsap.from(elements, animationParams);
                                    });
                                }
                                
                                // Reset animation params
                                animationParams = {};
                            });
                        }
                        
                        // TEXT MOVE ANIMATION
                        else if (this.getElementSettings("wcf_text_animation") === "text_move") {
                            var moveDuration = this.getElementSettings("text_duration");
                            var moveDelay = this.getElementSettings("text_delay");
                            var moveStagger = this.getElementSettings("text_stagger");
                            var moveOnScroll = this.getElementSettings("text_on_scroll");
                            var rotationDirection = this.getElementSettings("text_rotation_di");
                            var rotationAmount = this.getElementSettings("text_rotation");
                            var moveScrub = this.getElementSettings("spin_text_scrub");
                            var transformOrigin = this.getElementSettings("text_transform_origin");
                            
                            var timelineParams = {};
                            var childrenCount = this.findElement(".elementor-widget-container").children().length;
                            var targetElement = $(this.findElement(".elementor-widget-container").children()[childrenCount - 1]);
                            
                            // Handle nested text elements
                            if (targetElement.hasClass("wcf--text") && targetElement.children().length) {
                                targetElement = targetElement.children();
                            }
                            
                            // Parse scrub setting
                            moveScrub = typeof moveScrub === "number" 
                                ? this.getElementSettings("wcf_pin_scrub_number") 
                                : moveScrub === "yes";
                            
                            var animationParams = {
                                duration: moveDuration,
                                delay: moveDelay,
                                opacity: 0,
                                force3D: true,
                                transformOrigin: transformOrigin,
                                stagger: moveStagger
                            };
                            
                            if (rotationDirection === "x") {
                                animationParams.rotationX = rotationAmount;
                            } else if (rotationDirection === "y") {
                                animationParams.rotationY = rotationAmount;
                            }
                            
                            if (moveOnScroll) {
                                timelineParams.scrollTrigger = {
                                    trigger: targetElement,
                                    duration: 2,
                                    start: "top 90%",
                                    end: "bottom 60%",
                                    scrub: moveScrub,
                                    toggleActions: "play none none none"
                                };
                            }
                            
                            if (breakpointCondition === "all") {
                                var timeline = gsap.timeline(timelineParams);
                                var splitText = new SplitText(targetElement, { type: "lines" });
                                
                                gsap.set(targetElement, { perspective: 400 });
                                splitText.split({ type: "lines" });
                                timeline.from(splitText.lines, animationParams);
                            } else {
                                media.add("(" + breakpointCondition + ")", function() {
                                    var timeline = gsap.timeline(timelineParams);
                                    var splitText = new SplitText(targetElement, { type: "lines" });
                                    
                                    gsap.set(targetElement, { perspective: 400 });
                                    splitText.split({ type: "lines" });
                                    timeline.from(splitText.lines, animationParams);
                                    
                                    return function() {
                                        splitText.revert();
                                        timeline.revert();
                                    };
                                });
                            }
                        }
                        
                        // TEXT REVEAL ANIMATION
                        else if (this.getElementSettings("wcf_text_animation") === "text_reveal") {
                            var revealDuration = this.getElementSettings("text_duration");
                            var revealOnScroll = this.getElementSettings("text_on_scroll");
                            var revealStagger = this.getElementSettings("text_stagger");
                            var revealDelay = this.getElementSettings("text_delay");
                            var revealScrub = this.getElementSettings("spin_text_scrub");
                            
                            var childrenCount = this.findElement(".elementor-widget-container").children().length;
                            var targetElement = $(this.findElement(".elementor-widget-container").children()[childrenCount - 1]);
                            
                            // Parse scrub setting
                            revealScrub = typeof revealScrub === "number" 
                                ? this.getElementSettings("wcf_pin_scrub_number") 
                                : revealScrub === "yes";
                            
                            var splitText = new SplitText(targetElement, {
                                type: "lines,words,chars",
                                linesClass: "anim-reveal-line"
                            });
                            
                            var revealParams = {
                                duration: revealDuration,
                                delay: revealDelay,
                                ease: "circ.out",
                                y: 80,
                                stagger: revealStagger,
                                opacity: 0
                            };
                            
                            if (revealOnScroll) {
                                revealParams.scrollTrigger = {
                                    trigger: targetElement,
                                    start: "top 85%",
                                    scrub: revealScrub
                                };
                            }
                            
                            if (breakpointCondition === "all") {
                                gsap.from(splitText.chars, revealParams);
                            } else {
                                media.add("(" + breakpointCondition + ")", function() {
                                    gsap.from(splitText.chars, revealParams);
                                    return function() {
                                        splitText.revert();
                                    };
                                });
                            }
                        }
                        
                        // TEXT INVERT ANIMATION
                        else if (this.getElementSettings("wcf_text_animation") === "text_invert") {
                            var childrenCount = this.findElement(".elementor-widget-container").children().length;
                            var targetElement = $(this.findElement(".elementor-widget-container").children()[childrenCount - 1]);
                            var textColor = targetElement.css("color");
                            
                            // Convert RGB to HSL
                            textColor = function(r, g, b) {
                                r /= 255;
                                g /= 255;
                                b /= 255;
                                
                                var max = Math.max(r, g, b);
                                var min = Math.min(r, g, b);
                                var delta = max - min;
                                var hue = 0;
                                
                                if (delta) {
                                    if (max === r) {
                                        hue = (g - b) / delta;
                                    } else if (max === g) {
                                        hue = 2 + (b - r) / delta;
                                    } else {
                                        hue = 4 + (r - g) / delta;
                                    }
                                    
                                    hue *= 60;
                                    if (hue < 0) hue += 360;
                                }
                                
                                var lightness = (max + min) / 2;
                                var saturation = delta ? 
                                    (lightness <= 0.5 ? delta / (2 * lightness) : delta / (2 - (2 * lightness))) 
                                    : 0;
                                
                                return [
                                    hue.toFixed(1),
                                    (saturation * 100).toFixed(1) + "%",
                                    (lightness * 100).toFixed(1) + "%"
                                ];
                            }(
                                (textColor = textColor.toString().match(/(\d+)/g))[0],
                                textColor[1],
                                textColor[2]
                            );
                            
                            textColor = textColor[0] + ", " + textColor[1] + ", " + textColor[2];
                            targetElement.css("--text-color", textColor);
                            
                            if (breakpointCondition === "all") {
                                var splitText = new SplitText(targetElement, {
                                    type: "lines",
                                    linesClass: "invert-line"
                                });
                                
                                splitText.lines.forEach(function(line) {
                                    gsap.to(line, {
                                        backgroundPositionX: 0,
                                        ease: "none",
                                        scrollTrigger: {
                                            trigger: line,
                                            scrub: 1,
                                            start: "top 85%",
                                            end: "bottom center"
                                        }
                                    });
                                });
                            } else {
                                media.add("(" + breakpointCondition + ")", function() {
                                    var splitText = new SplitText(targetElement, {
                                        type: "lines",
                                        linesClass: "invert-line"
                                    });
                                    
                                    splitText.lines.forEach(function(line) {
                                        gsap.to(line, {
                                            backgroundPositionX: 0,
                                            ease: "none",
                                            scrollTrigger: {
                                                trigger: line,
                                                scrub: 1,
                                                start: "top 85%",
                                                end: "bottom center"
                                            }
                                        });
                                    });
                                    
                                    return function() {
                                        splitText.revert();
                                    };
                                });
                            }
                        }
                        
                        // TEXT SPIN ANIMATION
                        else if (this.getElementSettings("wcf_text_animation") === "text_spin") {
                            var createSpinAnimation = function() {
                                var spinOnScroll = self.getElementSettings("text_on_scroll");
                                var childrenCount = self.findElement(".elementor-widget-container").children().length;
                                var originalElement = $(self.findElement(".elementor-widget-container").children()[childrenCount - 1]);
                                var cloneElement = originalElement[0].cloneNode(true);
                                
                                // Setup clone element
                                $(cloneElement).addClass("duplicate-text");
                                originalElement.css({
                                    perspective: "600px",
                                    "white-space": "nowrap"
                                });
                                $(cloneElement).css({
                                    perspective: "600px",
                                    "white-space": "nowrap"
                                });
                                
                                var container = self.findElement(".elementor-widget-container")[0];
                                
                                // Insert clone and setup SplitText
                                originalElement.after(cloneElement);
                                gsap.set(cloneElement, { yPercent: -100 });
                                
                                container.originalSplit = SplitText.create(originalElement, { type: "chars" });
                                container.cloneSplit = SplitText.create(cloneElement, { type: "chars" });
                                
                                if (spinOnScroll) {
                                    var scrollTriggerConfig = {
                                        trigger: self.$element,
                                        animation: createSpinTimeline(container),
                                        invalidateOnRefresh: true
                                    };
                                    
                                    var spinOptions = {
                                        start: self.getElementSettings("spin_text_start"),
                                        end: self.getElementSettings("spin_text_end"),
                                        scrub: self.getElementSettings("spin_text_scrub") === "yes",
                                        toggleActions: self.getElementSettings("spin_text_toggle_action")
                                    };
                                    
                                    Object.assign(scrollTriggerConfig, spinOptions);
                                    ScrollTrigger.create(scrollTriggerConfig);
                                } else {
                                    createSpinTimeline(container);
                                }
                            };
                            
                            var createSpinTimeline = function(container) {
                                var spinDelay = self.getElementSettings("text_delay");
                                var staggerConfig = {
                                    each: 0.03,
                                    ease: "power1",
                                    from: "start"
                                };
                                
                                gsap.set(container.cloneSplit.chars, { opacity: 0 });
                                
                                var timeline = gsap.timeline();
                                
                                timeline.set(container.cloneSplit.chars, {
                                    rotationX: -90,
                                    transformOrigin: function() {
                                        var height = container.offsetHeight;
                                        return "50% 50% -" + (height / 2);
                                    }
                                });
                                
                                timeline.to(container.originalSplit.chars, {
                                    delay: spinDelay,
                                    duration: 0.4,
                                    rotationX: 90,
                                    transformOrigin: function() {
                                        var height = container.offsetHeight;
                                        return "50% 50% -" + (height / 2);
                                    },
                                    stagger: staggerConfig
                                });
                                
                                timeline.to(container.originalSplit.chars, {
                                    duration: 0.4,
                                    delay: spinDelay,
                                    opacity: 0,
                                    stagger: staggerConfig,
                                    ease: "power2.in"
                                }, 0);
                                
                                timeline.to(container.cloneSplit.chars, {
                                    duration: 0.001,
                                    delay: spinDelay,
                                    opacity: 1,
                                    stagger: staggerConfig
                                }, 0.001);
                                
                                timeline.to(container.cloneSplit.chars, {
                                    duration: 0.4,
                                    delay: spinDelay,
                                    rotationX: 0,
                                    stagger: staggerConfig
                                }, 0);
                                
                                return timeline;
                            };
                            
                            if (breakpointCondition === "all") {
                                createSpinAnimation();
                            } else {
                                media.add("(" + breakpointCondition + ")", function() {
                                    createSpinAnimation();
                                });
                            }
                        }
                        
                        // TEXT SCALE ANIMATION
                        else if (this.getElementSettings("wcf_text_animation") === "text_scale") {
                            var scaleDelay = this.getElementSettings("text_delay");
                            var scaleDuration = this.getElementSettings("text_duration");
                            var scaleOnScroll = this.getElementSettings("text_on_scroll");
                            var scaleStagger = this.getElementSettings("text_stagger");
                            var scaleAmount = this.getElementSettings("text_scale_num");
                            var scaleScrub = this.getElementSettings("spin_text_scrub");
                            var scaleEase = this.getElementSettings("scale_text_ease");
                            var scaleElementType = this.getElementSettings("text_scale_break");
                            var targetElement = this.findElement(".elementor-widget-container").find(":not(span.highlight)").last()[0];
                            
                            // Parse scrub setting
                            scaleScrub = typeof scaleScrub === "number" 
                                ? this.getElementSettings("wcf_pin_scrub_number") 
                                : scaleScrub === "yes";
                            
                            var splitText = new SplitText(targetElement, {
                                type: "lines words chars",
                                linesClass: "text-scale-anim"
                            });
                            
                            var elementsToAnimate = splitText[scaleElementType];
                            
                            if (!elementsToAnimate.length) {
                                return;
                            }
                            
                            var scaleParams = {
                                duration: scaleDuration,
                                autoAlpha: 0,
                                scale: scaleAmount,
                                stagger: scaleStagger,
                                transformOrigin: "50% 0%",
                                ease: scaleEase,
                                delay: scaleDelay
                            };
                            
                            if (scaleOnScroll) {
                                scaleParams.scrollTrigger = {
                                    trigger: targetElement,
                                    start: "top 85%",
                                    scrub: scaleScrub
                                };
                            }
                            
                            if (breakpointCondition === "all") {
                                gsap.from(elementsToAnimate, scaleParams);
                            } else {
                                media.add("(" + breakpointCondition + ")", function() {
                                    gsap.from(elementsToAnimate, scaleParams);
                                    return function() {
                                        splitText.revert();
                                    };
                                });
                            }
                        }
                    },
                    
                    // ======================
                    // IMAGE ANIMATIONS
                    // ======================
                    image_animation: function() {
                        // Skip if in edit mode and not enabled for editor
                        if (this.isEdit && !this.getElementSettings("wcf_img_animation_editor")) {
                            return;
                        }
                        
                        // REVEAL ANIMATION
                        if (this.getElementSettings("wcf-image-animation") === "reveal") {
                            var imageParents = this.findElement("img").parent();
                            var widgetElement = this.$element;
                            
                            // Setup container styles
                            this.findElement("img").parent().parent().css("overflow", "hidden");
                            imageParents.css({
                                overflow: "hidden",
                                display: "block",
                                visibility: "hidden",
                                transition: "none"
                            });
                            
                            var startPosition = this.getElementSettings("wcf-animation-start");
                            if (startPosition === "custom") {
                                startPosition = this.getElementSettings("wcf_animation_custom_start");
                            }
                            
                            var direction = this.getElementSettings("aae_a_start_from");
                            var easeType = this.getElementSettings("image-ease");
                            var hasEffectClass = false;
                            var effectClass = "";
                            
                            // Check for effect classes
                            $.each(["effect-zoom-in", "effect-zoom-out", "left-move", "right-move"], function(index, className) {
                                if (widgetElement.hasClass("wcf--image-" + className)) {
                                    hasEffectClass = true;
                                    effectClass = "wcf--image-" + className;
                                    widgetElement.removeClass(effectClass);
                                }
                            });
                            
                            // Create animations for each image
                            imageParents.each(function() {
                                var image = $(this).find("img");
                                var timeline = gsap.timeline({
                                    scrollTrigger: {
                                        trigger: $(this),
                                        start: startPosition
                                    }
                                });
                                
                                var revealParams = {
                                    ease: easeType,
                                    onComplete: function() {
                                        if (hasEffectClass) {
                                            widgetElement.addClass(effectClass);
                                            hasEffectClass = false;
                                        }
                                    }
                                };
                                
                                var imageParams = {
                                    scale: 1.3,
                                    delay: -1.5,
                                    ease: easeType
                                };
                                
                                // Set direction-based parameters
                                switch (direction) {
                                    case "left":
                                        revealParams.xPercent = 100;
                                        imageParams.xPercent = -100;
                                        break;
                                    case "right":
                                        revealParams.xPercent = -100;
                                        imageParams.xPercent = 100;
                                        break;
                                    case "top":
                                        revealParams.yPercent = 100;
                                        imageParams.yPercent = -100;
                                        break;
                                    case "bottom":
                                        revealParams.yPercent = -100;
                                        imageParams.yPercent = 100;
                                        break;
                                }
                                
                                timeline.set($(this), { autoAlpha: 1 });
                                timeline.from($(this), 1.5, revealParams);
                                timeline.from(image, 1.5, imageParams);
                            });
                        }
                        
                        // SCALE ANIMATION
                        else if (this.getElementSettings("wcf-image-animation") === "scale") {
                            var images = this.findElement("img");
                            var scaleStart = this.getElementSettings("wcf-animation-start");
                            
                            if (scaleStart === "custom") {
                                scaleStart = this.getElementSettings("wcf_animation_custom_start");
                            }
                            
                            gsap.set(images, { scale: this.getElementSettings("wcf-scale-start") });
                            
                            gsap.to(images, {
                                scrollTrigger: {
                                    trigger: this.$element,
                                    start: scaleStart,
                                    scrub: true
                                },
                                scale: this.getElementSettings("wcf-scale-end"),
                                ease: this.getElementSettings("image-ease")
                            });
                            
                            images.parent().css("overflow", "hidden");
                        }
                        
                        // STRETCH ANIMATION
                        else if (this.getElementSettings("wcf-image-animation") === "stretch") {
                            var stretchImages = this.findElement("img");
                            var imageContainer = this.findElement("img").parent();
                            
                            imageContainer.css("padding-bottom", "395px");
                            
                            gsap.timeline({
                                scrollTrigger: {
                                    trigger: imageContainer,
                                    start: "top top",
                                    pin: true,
                                    scrub: 1,
                                    pinSpacing: false,
                                    end: "bottom bottom+=100"
                                }
                            }).to(stretchImages, {
                                width: "100%",
                                borderRadius: "0px"
                            });
                            
                            imageContainer.css("transition", "none");
                        }
                    },
                    
                    // ======================
                    // FADE ANIMATIONS
                    // ======================
                    fade_animation: function() {
                        var self = this;
                        
                        // Skip if no animation or in edit mode and not enabled
                        if (this.getElementSettings("wcf-animation") === "none" || 
                            (this.isEdit && !this.getElementSettings("wcf_enable_animation_editor"))) {
                            return;
                        }
                        
                        var direction = this.getElementSettings("fade-from");
                        var onScroll = this.getElementSettings("on-scroll");
                        var duration = this.getElementSettings("data-duration");
                        var offset = this.getElementSettings("fade-offset");
                        var delay = this.getElementSettings("delay");
                        var ease = this.getElementSettings("ease");
                        var breakpointCondition = "all";
                        
                        // Remove default transitions
                        this.$element.css("transition", "none");
                        
                        // Set breakpoint condition
                        if (this.getElementSettings("fade_animation_breakpoint")) {
                            var breakpointValue = activeBreakpoints[this.getElementSettings("fade_animation_breakpoint")].value;
                            var minMax = this.getElementSettings("fade_breakpoint_min_max");
                            breakpointCondition = minMax === "min" 
                                ? "min-width: " + breakpointValue + "px" 
                                : "max-width: " + breakpointValue + "px";
                        }
                        
                        var fadeParams = {
                            opacity: 0,
                            ease: ease,
                            duration: duration,
                            delay: delay
                        };
                        
                        // FADE animation type
                        if (this.getElementSettings("wcf-animation") === "fade") {
                            switch (direction) {
                                case "top":
                                    fadeParams.y = -offset;
                                    break;
                                case "bottom":
                                    fadeParams.y = offset;
                                    break;
                                case "left":
                                    fadeParams.x = -offset;
                                    break;
                                case "right":
                                    fadeParams.x = offset;
                                    break;
                                case "scale":
                                    fadeParams.scale = this.getElementSettings("wcf-a-scale");
                                    break;
                            }
                        }
                        
                        // MOVE animation type
                        else if (this.getElementSettings("wcf-animation") === "move") {
                            var rotationDirection = this.getElementSettings("wcf_a_rotation_di");
                            var transformOrigin = this.getElementSettings("wcf_a_transform_origin");
                            var rotationAmount = this.getElementSettings("wcf_a_rotation");
                            
                            fadeParams.force3D = true;
                            fadeParams.transformOrigin = transformOrigin;
                            
                            if (rotationDirection === "x") {
                                fadeParams.rotationX = rotationAmount;
                            } else if (rotationDirection === "y") {
                                fadeParams.rotationY = rotationAmount;
                            }
                            
                            gsap.set(this.$element.parent(), { perspective: 400 });
                        }
                        
                        // Add scroll trigger if enabled
                        if (onScroll) {
                            fadeParams.scrollTrigger = {
                                trigger: this.$element,
                                start: "top 85%"
                            };
                        }
                        
                        // Apply animation based on breakpoint
                        if (breakpointCondition === "all") {
                            gsap.from(this.$element, fadeParams);
                        } else {
                            media.add("(" + breakpointCondition + ")", function() {
                                gsap.from(self.$element, fadeParams);
                                return function() {};
                            });
                        }
                    },
                    
                    // ======================
                    // BUTTON ANIMATIONS
                    // ======================
                    button_move_animation: function() {
                        // Button movement on mouse hover
                        var buttonWrapper = this.findElement(".btn-wrapper");
                        var buttonItem = this.findElement(".btn-item");
                        
                        if (buttonWrapper.length) {
                            var moveButton = function(event, element, intensity) {
                                var xPos = event.pageX - buttonWrapper.offset().left;
                                var yPos = event.pageY - buttonWrapper.offset().top;
                                
                                gsap.to(element, 0.5, {
                                    x: (xPos - buttonWrapper.width() / 2) / buttonWrapper.width() * intensity,
                                    y: (yPos - buttonWrapper.height() / 2) / buttonWrapper.height() * intensity,
                                    ease: Power2.easeOut
                                });
                            };
                            
                            buttonWrapper.mousemove(function(event) {
                                moveButton(event, buttonItem, 80);
                            });
                            
                            buttonWrapper.mouseleave(function(event) {
                                gsap.to(buttonItem, 0.5, {
                                    x: 0,
                                    y: 0,
                                    ease: Power2.easeOut
                                });
                            });
                        }
                        
                        // Button background change on hover
                        var hoverButton = this.findElement(".btn-hover-bgchange");
                        
                        if (hoverButton.length) {
                            var hoverSpan = document.createElement("span");
                            hoverButton.append(hoverSpan);
                            
                            hoverButton.on("mouseenter", function(event) {
                                var xPos = event.pageX - $(this).offset().left;
                                var yPos = event.pageY - $(this).offset().top;
                                $(this).find("span").css({
                                    top: yPos,
                                    left: xPos
                                });
                            });
                            
                            hoverButton.on("mouseout", function(event) {
                                var xPos = event.pageX - $(this).offset().left;
                                var yPos = event.pageY - $(this).offset().top;
                                $(this).find("span").css({
                                    top: yPos,
                                    left: xPos
                                });
                            });
                        }
                    }
                });
                
                // Register widget animation handler
                elementorFrontend.hooks.addAction("frontend/element_ready/widget", function($element) {
                    elementorFrontend.elementsHandler.addHandler(WidgetAnimationHandler, { $element: $element });
                });
                
                elementorFrontend.hooks.addAction("frontend/element_ready/container", function($element) {
                    elementorFrontend.elementsHandler.addHandler(WidgetAnimationHandler, { $element: $element });
                });
                
                // ======================
                // PIN AREA HANDLER
                // ======================
                var PinAreaHandler = BaseHandler.extend({
                    bindEvents: function() {
                        var breakpointValue;
                        
                        // Skip if in edit mode or pin area not enabled
                        if (this.isEdit || this.getElementSettings("wcf_enable_pin_area") !== "yes") {
                            return;
                        }
                        
                        // Check breakpoint condition
                        if (this.getElementSettings("wcf_pin_breakpoint")) {
                            breakpointValue = activeBreakpoints[this.getElementSettings("wcf_pin_breakpoint")];
                            if (windowWidth > (breakpointValue ? breakpointValue.value : 0)) {
                                this.run();
                            }
                        } else {
                            this.run();
                        }
                    },
                    
                    run: function() {
                        var pinElement = this.$element;
                        var startPosition = this.getElementSettings("wcf_pin_area_start");
                        var endPosition = this.getElementSettings("wcf_pin_area_end");
                        var endTrigger = this.getElementSettings("wcf_pin_end_trigger");
                        var pinStatus = this.getElementSettings("wcf_pin_status");
                        var pinSpacing = this.getElementSettings("wcf_pin_spacing");
                        var pinType = this.getElementSettings("wcf_pin_type");
                        var scrub = this.getElementSettings("wcf_pin_scrub");
                        var markers = this.getElementSettings("wcf_pin_markers");
                        
                        // Parse settings
                        scrub = typeof scrub === "number" 
                            ? this.getElementSettings("wcf_pin_scrub_number") 
                            : scrub === "true";
                        
                        pinSpacing = pinSpacing === "custom" 
                            ? this.getElementSettings("wcf_pin_spacing_custom") 
                            : pinSpacing === "true";
                        
                        pinStatus = pinStatus === "custom" 
                            ? this.getElementSettings("wcf_pin_custom") 
                            : pinStatus === "true";
                        
                        // Custom start/end positions
                        if (startPosition === "custom") {
                            startPosition = this.getElementSettings("wcf_pin_area_start_custom");
                        }
                        if (endPosition === "custom") {
                            endPosition = this.getElementSettings("wcf_pin_area_end_custom");
                        }
                        
                        // Custom pin area element
                        if (this.getElementSettings("wcf_custom_pin_area")) {
                            pinElement = this.getElementSettings("wcf_custom_pin_area");
                        }
                        
                        // Create pin animation
                        gsap.to(this.$element, {
                            scrollTrigger: {
                                trigger: pinElement,
                                endTrigger: endTrigger,
                                pin: pinStatus,
                                pinSpacing: pinSpacing,
                                pinType: pinType,
                                start: startPosition,
                                end: endPosition,
                                scrub: scrub,
                                delay: 0.5,
                                markers: markers === "true"
                            }
                        });
                        
                        this.$element.css("transition", "none");
                    }
                });
                
                // Register pin area handler
                elementorFrontend.hooks.addAction("frontend/element_ready/container", function($element) {
                    elementorFrontend.elementsHandler.addHandler(PinAreaHandler, { $element: $element });
                });
                
                // ======================
                // POPUP HANDLER
                // ======================
                var PopupHandler = BaseHandler.extend({
                    bindEvents: function() {
                        this.run();
                    },
                    
                    run: function() {
                        var self = this;
                        
                        // Check if popup is enabled
                        if (!this.getElementSettings("wcf_enable_popup")) {
                            return;
                        }
                        
                        var elementId = this.$element[0].closest("[data-elementor-id]").getAttribute("data-elementor-id");
                        var requireLogin = this.getElementSettings("wcf_enable_login_user");
                        var loadDelay = this.getElementSettings("wcf_load_after_xtime") || 0;
                        var showLimit = this.getElementSettings("wcf_show_up_to_xtime") || -1;
                        var pageviewLimit = this.getElementSettings("wcf_load_after_x_pageviews") || 0;
                        var allowedDevices = this.getElementSettings("wcf_show_x_devices") || [];
                        
                        var popupStorageKey = "aae_addon_popup_" + this.getID();
                        var pageviewStorageKey = "aae_addon_page_" + this.getID();
                        var popupShowCount = parseInt(localStorage.getItem(popupStorageKey)) || 1;
                        
                        // PAGE LOAD TRIGGER
                        if (this.getElementSettings("popup_condition") === "pageloaded") {
                            var shouldShowPopup = function() {
                                // Skip in edit mode if not enabled for editor
                                if (self.isEdit && self.getElementSettings("wcf_enable_popup_editor") !== "yes") {
                                    return false;
                                }
                                
                                // Check show limit
                                if (showLimit > 0 && showLimit === popupShowCount) {
                                    return false;
                                }
                                
                                // Check login requirement
                                if (WCF_ADDONS_JS && WCF_ADDONS_JS.isLoggedIn) {
                                    return requireLogin === "yes";
                                }
                                
                                // Check device restriction
                                if (allowedDevices.length) {
                                    var currentDevice = window.elementorFrontend.getCurrentDeviceMode();
                                    if (!allowedDevices.includes(currentDevice)) {
                                        return false;
                                    }
                                }
                                
                                // Check pageview limit
                                if (pageviewLimit) {
                                    var pageviewCount = parseInt(localStorage.getItem(pageviewStorageKey)) || 0;
                                    localStorage.setItem(pageviewStorageKey, pageviewCount + 1);
                                    
                                    if (pageviewLimit > pageviewCount) {
                                        return false;
                                    }
                                }
                                
                                // Update show count and return true
                                localStorage.setItem(popupStorageKey, popupShowCount + 1);
                                return true;
                            };
                            
                            if (shouldShowPopup()) {
                                setTimeout(function() {
                                    self.ajax_call(elementId);
                                }, loadDelay);
                            }
                        }
                        // CLICK TRIGGER
                        else {
                            this.$element.on("click", function(event) {
                                event.preventDefault();
                                
                                if (self.isEdit && !self.getElementSettings("wcf_enable_popup_editor")) {
                                    return;
                                }
                                
                                self.ajax_call(elementId);
                            });
                        }
                    },
                    
                    ajax_call: function(elementId) {
                        var animationTimeline = null;
                        
                        $.ajax({
                            url: WCF_ADDONS_JS.ajaxUrl,
                            data: {
                                action: "wcf_load_popup_content",
                                element_id: this.getID(),
                                post_id: elementId || WCF_ADDONS_JS.post_id,
                                nonce: WCF_ADDONS_JS._wpnonce
                            },
                            dataType: "json",
                            type: "POST",
                            success: function(response) {
                                // Ensure popup container exists
                                if (!$("#wcf-aae-global--popup-js").find(".aae-popup-content-container").length) {
                                    $("body > #wcf-aae-global--popup-js").find(".aae-popup-content-container").html('<div class="aae-popup-content"></div>');
                                }
                                
                                // Update popup content
                                $("#wcf-aae-global--popup-js").find(".aae-popup-content-container").html(response.html);
                                
                                // Create popup animation
                                window.VideoAnimation = gsap.timeline({
                                    defaults: { ease: "power2.inOut" }
                                })
                                .to("#wcf-aae-global--popup-js", {
                                    scaleY: 0.01,
                                    x: 1,
                                    opacity: 1,
                                    visibility: "visible",
                                    duration: 0.4
                                })
                                .to("#wcf-aae-global--popup-js", {
                                    scaleY: 1,
                                    duration: 0.6
                                })
                                .to("#wcf-aae-global--popup-js .wcf--popup-video", {
                                    scaleY: 1,
                                    opacity: 1,
                                    visibility: "visible",
                                    duration: 0.6
                                }, "-=0.4");
                            }
                        });
                        
                        // Close popup handler
                        $(document).on("click", "#wcf-aae-global--popup-js .wcf--popup-close", function() {
                            if (animationTimeline) {
                                animationTimeline.timeScale(1.6).reverse();
                                animationTimeline = null;
                            }
                        });
                    }
                });
                
                // Register popup handler
                elementorFrontend.hooks.addAction("frontend/element_ready/container", function($element) {
                    elementorFrontend.elementsHandler.addHandler(PopupHandler, { $element: $element });
                });
                
                // ======================
                // VIDEO MASK HANDLER
                // ======================
                elementorFrontend.hooks.addAction("frontend/element_ready/wcf--video-mask.default", function($element) {
                    $(".video--btn", $element).on("click", function() {
                        $element.toggleClass("mask-open");
                        $(".open-title", $element).toggle();
                        $(".close-title", $element).toggle();
                        
                        var maskId = $element.data("id");
                        $element.closest(".wcf-video-mask-content").toggleClass("wcf-video-mask-content-" + maskId);
                        
                        $("video", $element).each(function() {
                            if (!this.autoplay) {
                                if (this.paused) {
                                    this.play();
                                } else {
                                    this.pause();
                                }
                            }
                        });
                    });
                });
                
                // ======================
                // VIDEO POPUP HANDLER
                // ======================
                var setupVideoPopup = function($element) {
                    var popupWrapper = $(".wcf--popup-video-wrapper").first();
                    
                    // Move popup wrapper to body if not already there
                    if (!popupWrapper.parent().is("body") && !$("body > .wcf--popup-video-wrapper").length) {
                        popupWrapper.appendTo("body");
                    }
                    
                    // Clean up existing handlers and elements
                    $element.find(".wcf--popup-video-wrapper").remove();
                    
                    // Setup click handler for popup buttons
                    $element.find(".wcf-popup-btn").off("click").on("click", function() {
                        var videoSrc = $(this).attr("data-src");
                        
                        // Clear existing content
                        $(".wcf--popup-video-wrapper").find(".aae-popup-content-container").html("");
                        
                        // Add iframe if not present
                        if (!popupWrapper.find("iframe").length) {
                            $("body > .wcf--popup-video-wrapper").find(".aae-popup-content-container").html('<iframe src="' + videoSrc + '" ></iframe>');
                        }
                        
                        // Create popup animation
                        window.VideoAnimation = gsap.timeline({
                            defaults: { ease: "power2.inOut" }
                        })
                        .to(".wcf--popup-video-wrapper", {
                            scaleY: 0.01,
                            x: 1,
                            opacity: 1,
                            visibility: "visible",
                            duration: 0.4
                        })
                        .to(".wcf--popup-video-wrapper", {
                            scaleY: 1,
                            duration: 0.6
                        })
                        .to(".wcf--popup-video-wrapper .wcf--popup-video", {
                            scaleY: 1,
                            opacity: 1,
                            visibility: "visible",
                            duration: 0.6
                        }, "-=0.4");
                    });
                };
                
                // Close video popup function
                var closeVideoPopup = function(timeline) {
                    if (timeline) {
                        window.VideoAnimation.timeScale(1.6).reverse();
                        $(".aae-popup-content-container").html("");
                    }
                };
                
                $(document).on("click", ".wcf--popup-video-wrapper .wcf--popup-close", function() {
                    closeVideoPopup(VideoAnimation);
                    window.VideoAnimation = null;
                });
                
                // ======================
                // VIDEO BOX HOVER HANDLER
                // ======================
                var setupVideoHover = function($element) {
                    var videoElement = $(".thumb video", $element);
                    
                    if (videoElement.length) {
                        $(".wcf--video-box", $element).hover(
                            function() {
                                videoElement.get(0).play();
                            },
                            function() {
                                videoElement.get(0).pause();
                                videoElement.get(0).currentTime = 0;
                            }
                        );
                    }
                };
                
                // Register video handlers for different widget types
                var videoWidgetTypes = ["video-box", "video-box-slider"];
                
                for (var i = 0; i < videoWidgetTypes.length; i++) {
                    var widgetType = videoWidgetTypes[i];
                    elementorFrontend.hooks.addAction("frontend/element_ready/wcf--" + widgetType + ".default", setupVideoHover);
                }
                
                // Register video popup handlers
                elementorFrontend.hooks.addAction("frontend/element_ready/wcf--video-popup.default", setupVideoPopup);
                elementorFrontend.hooks.addAction("frontend/element_ready/wcf--video-box.default", setupVideoPopup);
                elementorFrontend.hooks.addAction("frontend/element_ready/wcf--video-box-slider.default", setupVideoPopup);
            }
        }
    });
})(jQuery);

// Initialize image load refresh when DOM is ready
document.addEventListener("DOMContentLoaded", aaerefreshOnImageLoad);