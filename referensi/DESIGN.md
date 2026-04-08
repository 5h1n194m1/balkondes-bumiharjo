# Design System Strategy: The Timeless Curator

## 1. Overview & Creative North Star
The "Timeless Curator" is a design system built on the tension between ancient heritage and modern precision. Our North Star is **Editorial Stateliness**—the feeling of a high-end cultural journal where every image and paragraph has room to breathe. 

We break the "template" look by rejecting rigid, boxy layouts. Instead, we use **Intentional Asymmetry** and **Tonal Depth**. Imagine elements layered like fine sheets of handmade paper and frosted glass. We favor large-scale typography and overlapping components that break the container, creating a sense of movement and life that feels "sweet" yet authoritative.

---

## 2. Colors & Tonal Architecture
The palette transitions from the grounded warmth of terracotta to the ethereal lightness of "Rice Silk." We use color not just for decoration, but as the primary tool for spatial definition.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders to section content. Boundaries must be defined solely through background color shifts. For example, a `surface-container-low` section should sit directly against a `surface` background to create a soft, organic edge.

### Surface Hierarchy & Nesting
Instead of a flat grid, treat the UI as a physical stack.
*   **Base:** `surface` (#fff8ef) is your canvas.
*   **Nesting:** Use `surface-container-lowest` to `highest` to create depth. A card should not "sit" on a page; it should "emerge" from it by being a slightly lighter or darker tier than its parent container.
*   **The Glass & Gradient Rule:** For primary CTAs or high-impact headers, use subtle linear gradients (e.g., `primary` to `primary_container`). Floating navigation menus should utilize a semi-transparent `surface` color with a `backdrop-blur` of 12px–20px to create a "frosted glass" effect, allowing background colors to bleed through softly.

---

## 3. Typography: The Heritage Voice
The type system pairs the intellectual weight of Noto Serif with the modern clarity of Plus Jakarta Sans.

*   **Display & Headlines (Noto Serif):** These are the "soul" of the system. Use `display-lg` for hero moments with tight letter-spacing (-2%). Use `headline-md` for section titles to establish a "Heritage" feel.
*   **Body & Labels (Plus Jakarta Sans):** To maintain professionalism, all functional text uses this airy sans-serif. Use `body-lg` (1rem) for general reading to ensure the experience feels premium and unhurried.
*   **Hierarchy:** Always maintain a high contrast between headline and body sizes. A large serif headline paired with a small, tracked-out sans-serif label (`label-md`) creates an immediate editorial aesthetic.

---

## 4. Elevation & Depth
We eschew traditional "drop shadows" in favor of **Tonal Layering**.

*   **The Layering Principle:** Depth is achieved by stacking `surface-container` tiers. A `surface-container-lowest` card placed on a `surface-container-low` background creates a natural lift without a single shadow.
*   **Ambient Shadows:** If a floating element (like a modal) requires a shadow, it must be ultra-diffused: 
    *   *Y: 20px, Blur: 40px, Spread: -5px.*
    *   *Color:* Use `on-surface` at 4%–8% opacity. Never use pure black or grey; the shadow must be tinted with the surface's warmth.
*   **The "Ghost Border" Fallback:** If a border is required for accessibility, use the `outline_variant` at **15% opacity**. 100% opaque borders are forbidden.

---

## 5. Components & Interface Patterns

### Buttons
*   **Primary:** Rounded `lg` (1rem). Background: `primary`. Text: `on_primary`. Use a subtle inner-glow (white at 10%) on the top edge to give it a "pressed silk" feel.
*   **Secondary:** Glassmorphic. Background: `surface_variant` at 40% opacity with `backdrop-blur`.

### Cards & Lists
*   **Forbid Divider Lines:** Never use a horizontal line to separate list items. Use vertical white space (32px+) or subtle background shifts (`surface-container-low` vs `surface-container-high`).
*   **Card Styling:** Use `xl` (1.5rem) corner radius. Elements inside should "float" with generous padding (min 32px).

### Input Fields
*   **Styling:** Background-fill only using `surface_container_highest`. No bottom-line or full-border. Use `label-sm` in `secondary` for the floating label to keep the look sophisticated.

### Interactive "Heritage" Chips
*   Use `secondary_container` with `on_secondary_container` text. Keep corners `full` (pill-shaped) to contrast against the more structured `lg` corners of the cards.

---

## 6. Motion & Living Surfaces
Motion is the "Dynamic" soul of this system. It should never be jarring, only additive.

*   **The Subtle Parallax:** Hero images should move at 10% of the scroll speed. Background "Rice Silk" shapes should drift slightly slower than foreground content to create a sense of three-dimensional space.
*   **The "Sweet" Fade:** When elements enter the viewport, use a combined `Fade-In + Slide-Up` (20px). 
    *   *Duration:* 800ms. 
    *   *Easing:* `cubic-bezier(0.22, 1, 0.36, 1)` (the "Quartic Out" curve) for a smooth, high-end feel.
*   **Glass Transitions:** When hovering over glassmorphic cards, increase the `backdrop-blur` from 12px to 24px and slightly lighten the background opacity.

---

## 7. Do’s and Don’ts

*   **DO:** Use asymmetrical padding (e.g., 5% left, 10% right) in hero sections to break the "web template" feel.
*   **DO:** Overlap elements. Let a serif headline bleed over the edge of a glassmorphic card or an image.
*   **DON’T:** Use high-contrast borders or separators.
*   **DON’T:** Use generic icons. Use thin-stroke (1.5px) custom iconography that matches the `outline` color.
*   **DON’T:** Crowd the content. If a section feels "busy," increase the vertical `surface` spacing.