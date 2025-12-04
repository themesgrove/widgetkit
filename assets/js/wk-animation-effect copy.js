// ======================
// TEXT ANIMATIONS ONLY
// ======================
(function($) {
    $(window).on("elementor/frontend/init", function() {
        // Check if elementorFrontend exists
        if (typeof elementorFrontend !== "undefined" && elementorFrontend) {
            var BaseHandler = elementorModules.frontend.handlers.Base;
            var activeBreakpoints = elementorFrontend.config.responsive.activeBreakpoints;
            
            if (typeof gsap !== "undefined") {
                var media = gsap.matchMedia();
                
                // Register ScrollTrigger if available
                if (typeof ScrollTrigger !== "undefined") {
                    gsap.registerPlugin(ScrollTrigger);
                }
                
                // ======================
                // TEXT ANIMATION HANDLER
                // ======================
                var TextAnimationHandler = BaseHandler.extend({
                    bindEvents: function() { 
                        this.run();
                    },
                    
                    run: function() {
                        var self = this;
                        
                        if (this.getElementType() === "widget") {
                            if (this.isEdit) {
                                this.text_animation();
                            } else {
                                // Wait for fonts to load before text animation
                                document.fonts.ready.then(function() {
                                    self.text_animation();
                                });
                            }
                        }
                    },
                    
                    // ======================
                    // TEXT ANIMATIONS
                    // ======================
                    text_animation: function() {
                        var self = this;
                        
                        // Skip if in edit mode and not enabled for editor
                        if (this.isEdit && !this.getElementSettings("wk_text_animation_editor")) {
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
                        if (this.getElementSettings("wk_text_animation") === "char" || 
                            this.getElementSettings("wk_text_animation") === "word") {
                            
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
                                ? this.getElementSettings("wk_pin_scrub_number") 
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
                                if (self.getElementSettings("wk_text_animation") === "word") {
                                    elements = splitText.words;
                                }
                                
                                if (breakpointCondition === "all") {
                                    gsap.from(elements, animationParams);
                                } else {
                                    media.add("(" + breakpointCondition + ")", function() {
                                        gsap.from(elements, animationParams);
                                    });
                                }
                            });
                        }
                        
                        // TEXT MOVE ANIMATION
                        else if (this.getElementSettings("wk_text_animation") === "text_move") {
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
                            if (targetElement.hasClass("wk--text") && targetElement.children().length) {
                                targetElement = targetElement.children();
                            }
                            
                            // Parse scrub setting
                            moveScrub = typeof moveScrub === "number" 
                                ? this.getElementSettings("wk_pin_scrub_number") 
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
                        else if (this.getElementSettings("wk_text_animation") === "text_reveal") {
                            var revealDuration = this.getElementSettings("text_duration");
                            var revealOnScroll = this.getElementSettings("text_on_scroll");
                            var revealStagger = this.getElementSettings("text_stagger");
                            var revealDelay = this.getElementSettings("text_delay");
                            var revealScrub = this.getElementSettings("spin_text_scrub");
                            
                            var childrenCount = this.findElement(".elementor-widget-container").children().length;
                            var targetElement = $(this.findElement(".elementor-widget-container").children()[childrenCount - 1]);
                            
                            // Parse scrub setting
                            revealScrub = typeof revealScrub === "number" 
                                ? this.getElementSettings("wk_pin_scrub_number") 
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
                        else if (this.getElementSettings("wk_text_animation") === "text_invert") {
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
                        else if (this.getElementSettings("wk_text_animation") === "text_spin") {
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
                        else if (this.getElementSettings("wk_text_animation") === "text_scale") {
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
                                ? this.getElementSettings("wk_pin_scrub_number") 
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
                    }
                });
                
                // Register text animation handler for widgets
                elementorFrontend.hooks.addAction("frontend/element_ready/widget", function($element) {
                    elementorFrontend.elementsHandler.addHandler(TextAnimationHandler, { $element: $element });
                });
                
                // Also register for containers if needed
                elementorFrontend.hooks.addAction("frontend/element_ready/container", function($element) {
                    elementorFrontend.elementsHandler.addHandler(TextAnimationHandler, { $element: $element });
                });
            }
        }
    });
})(jQuery);