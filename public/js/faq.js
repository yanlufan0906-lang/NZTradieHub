(() => {
    const animationOptions = {
        duration: 260,
        easing: 'cubic-bezier(0.22, 1, 0.36, 1)',
        fill: 'both',
    };
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    document.querySelectorAll('.faq-list details').forEach((details) => {
        const summary = details.querySelector(':scope > summary');
        const answer = details.querySelector(':scope > .faq-answer');

        if (!summary || !answer) {
            return;
        }

        const finishAnimation = (isOpen, detailsAnimation, answerAnimation) => {
            details.open = isOpen;
            details.style.height = '';
            details.style.overflow = '';
            delete details.dataset.faqAnimating;
            detailsAnimation.cancel();
            answerAnimation.cancel();
        };

        const expand = () => {
            const startHeight = details.offsetHeight;
            details.open = true;
            const endHeight = details.offsetHeight;

            details.dataset.faqAnimating = 'true';
            details.style.overflow = 'hidden';

            const detailsAnimation = details.animate(
                {
                    height: [`${startHeight}px`, `${endHeight}px`],
                },
                animationOptions,
            );
            const answerAnimation = answer.animate(
                [
                    { opacity: 0, transform: 'translateY(-6px)' },
                    { opacity: 1, transform: 'translateY(0)' },
                ],
                animationOptions,
            );

            detailsAnimation.addEventListener('finish', () => {
                finishAnimation(true, detailsAnimation, answerAnimation);
            }, { once: true });
        };

        const collapse = () => {
            const startHeight = details.offsetHeight;
            const styles = window.getComputedStyle(details);
            const borderHeight = Number.parseFloat(styles.borderTopWidth)
                + Number.parseFloat(styles.borderBottomWidth);
            const endHeight = summary.offsetHeight + borderHeight;

            details.dataset.faqAnimating = 'true';
            details.style.overflow = 'hidden';

            const detailsAnimation = details.animate(
                {
                    height: [`${startHeight}px`, `${endHeight}px`],
                },
                animationOptions,
            );
            const answerAnimation = answer.animate(
                [
                    { opacity: 1, transform: 'translateY(0)' },
                    { opacity: 0, transform: 'translateY(-6px)' },
                ],
                animationOptions,
            );

            detailsAnimation.addEventListener('finish', () => {
                finishAnimation(false, detailsAnimation, answerAnimation);
            }, { once: true });
        };

        summary.addEventListener('click', (event) => {
            if (reducedMotion.matches || typeof details.animate !== 'function') {
                return;
            }

            event.preventDefault();

            if (details.dataset.faqAnimating === 'true') {
                return;
            }

            if (details.open) {
                collapse();
            } else {
                expand();
            }
        });
    });
})();
