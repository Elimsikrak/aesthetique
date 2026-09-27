# AESTHETIQUE | TODO (Master Configuration)

## Plan Approval Pending
- Update visual identity styling (Heritage Luxe: Deep Madder Red, EB Garamond, Inter).
- Reconfigure header/footer/nav to match required brand directives.
- Ensure pages keep existing file structure and PHP/session cart behavior (`$_SESSION['cart']`).
- Adjust catalog/product/cart/checkout/admin UI to use consistent design tokens.

## Steps
1. Read/identify shared UI code (includes/header.php, includes/navbar.php, includes/footer.php) and page templates.
2. Implement design system tokens centrally (fonts + color variables) without changing file structure.
3. Rework header/nav: sticky, Heritage/Modern/Collections/Our Story links + minimal icons.
4. Rework footer: full site map, social links, Gothatar address.
5. Fix product cards styling: NPR pricing formatting, category labels.
6. Add/adjust “Our Story” narrative page section on index/product where needed.
7. Keep cart state via `$_SESSION['cart']` and ensure cart icon count uses session.
8. Verify admin login/dashboard styling to match theme.
9. Run quick manual checks: open key endpoints in browser.

