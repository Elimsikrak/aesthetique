/**
 * AESTHETIQUE Atelier UI Engine
 * Handles dynamic interface state updates and micro-interactions.
 */
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Dynamic Asset Upload Label Updates
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            const fileName = e.target.files[0]?.name;
            // Locate the contextual description paragraph next to or within the upload window
            const descriptorText = input.closest('div').querySelector('p.text-[11px]');
            
            if (fileName && descriptorText) {
                descriptorText.textContent = `Selected: ${fileName}`;
                descriptorText.classList.remove('text-neutral-500');
                descriptorText.classList.add('text-neutral-900', 'font-semibold');
            }
        });
    });

    // 2. Automate System Alerts Lifecycle Management
    // Automatically fades out PHP system messages after a standard incubation window (5 seconds)
    const alertBanners = document.querySelectorAll('.bg-red-50, .bg-neutral-900');
    alertBanners.forEach(banner => {
        // Exclude absolute structural layout parameters if necessary
        if (banner.querySelector('.fa-circle-exclamation') || banner.querySelector('.fa-circle-check')) {
            setTimeout(() => {
                banner.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                banner.style.opacity = '0';
                banner.style.transform = 'translateY(-8px)';
                
                setTimeout(() => {
                    banner.remove();
                }, 500);
            }, 5000);
        }
    });

    // 3. Dynamic Price Configuration Sanitizer
    const priceFields = document.querySelectorAll('input[name="price"]');
    priceFields.forEach(field => {
        field.addEventListener('blur', () => {
            if (field.value) {
                // Constrain values to strict float structural arrays
                const value = parseFloat(field.value);
                if (!isNaN(value) && value < 0) {
                    field.value = '0.00';
                }
            }
        });
    });
});