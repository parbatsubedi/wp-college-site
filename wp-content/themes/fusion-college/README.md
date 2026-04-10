# Fusion College WordPress Theme

A pixel-perfect WordPress theme converted from the Fusion College of Technology Laravel application. Features Gutenberg block support, ACF Flexible Content, dynamic menus, and custom post types.

## Features

- **Pixel-Perfect Design**: Identical to the original Laravel UI with the same color scheme, typography, and layout
- **Dark/Light Mode**: Theme toggle with system preference detection
- **Gutenberg Ready**: Full block editor support for content creation
- **ACF Flexible Content**: Visual page building with reusable sections (Hero, About, Courses, Events, Testimonials, CTA)
- **Custom Post Types**: Courses, Events, Announcements, Gallery, Hero Banners
- **Dynamic Menus**: Header and footer menus controlled via Appearance > Menus
- **Responsive Design**: Mobile-first with breakpoints at 1024px and 768px
- **AJAX Contact Form**: Built-in contact form with AJAX submission
- **Scroll Animations**: Fade-in animations and counter animations
- **Hero Slider**: Auto-advancing 3-slide hero with text animations

## Installation

### 1. Upload Theme

1. Navigate to **Appearance > Themes > Add New > Upload Theme**
2. Select the `fusion-college.zip` file
3. Click **Install Now**
4. Click **Activate**

### 2. Required Setup Steps

#### Import Demo Data
After activating the theme:
1. Go to **Tools > Fusion College Demo Data**
2. Click **Import Demo Data**
3. This creates sample courses, events, and pages

#### Set Up Menus
1. Go to **Appearance > Menus**
2. Create a new menu (e.g., "Primary Menu")
3. Add your pages: Home, About Us, Courses, Admissions, Events, Contact
4. Check **Primary Menu** under "Display location"
5. Create a footer menu if desired and check **Footer Menu**
6. Save Menu

#### Set Front Page
1. Go to **Settings > Reading**
2. Under "Your homepage displays", select **A static page**
3. Set **Homepage** to your desired front page (or create a new page with "Front Page" template)
4. Save Changes

#### Configure College Settings
1. Go to **Appearance > Customize > College Settings**
2. Set your:
   - College Name
   - Tagline
   - Phone Number
   - Email Address
   - Address
   - RTO Number
   - CRICOS Code
   - Hero Badge, Title, Subtitle
3. Click **Publish**

### 3. Recommended Plugins

#### Advanced Custom Fields (ACF) - Optional but Recommended
The theme includes programmatically registered ACF field groups. Install ACF to unlock:
- Flexible Content fields for home page sections
- Additional course fields (curriculum, career outcomes, etc.)
- Additional event fields (organizer, registration URL, capacity)

Install from: https://wordpress.org/plugins/advanced-custom-fields/

Once ACF is installed, the field groups are automatically available when editing pages and CPTs.

#### Using ACF Flexible Content for Home Page
1. Edit your front page
2. Scroll to "Home Page Sections"
3. Click **Add Section** to add:
   - Hero Section
   - Stats Section
   - About Section
   - Featured Courses
   - Why Choose Us
   - Upcoming Events
   - Testimonials
   - Call to Action
   - Custom Content
4. Reorder sections by dragging
5. Update/Publish

## Custom Post Types

### Courses
- **URL**: `/courses/`
- **Fields**: Duration, Fee, CRICOS Code, Study Mode, Intake Months, Location
- **Taxonomy**: Course Category (IT, Business, Leadership, etc.)
- **ACF Fields** (if ACF installed): Curriculum, Career Outcomes, Entry Requirements, How to Apply, International Requirements, Fees & Payment Info, Policies & Forms

### Events
- **URL**: `/events/`
- **Fields**: Start Date, End Date, Location
- **Taxonomy**: Event Category (Workshop, Networking, Graduation, etc.)
- **ACF Fields** (if ACF installed): Organizer, Registration URL, Capacity

### Announcements
- **URL**: `/announcements/`
- Standard post-type with title and content

### Gallery
- **URL**: `/gallery/`
- **Taxonomy**: Gallery Category
- Use featured images for gallery items

### Hero Banners
- Custom post type for managing hero slider content
- **Fields**: Subtitle, Description, Button Text, Button Link, Order

## Page Templates

| Template | File | Purpose |
|----------|------|---------|
| Front Page | `front-page.php` | Homepage with sections |
| Courses Page | `page-courses.php` | Course listing with category filter |
| Admissions Page | `page-admissions.php` | Admissions with course selector |
| Events Page | `page-events.php` | Events listing (upcoming + past) |
| Contact Page | `page-contact.php` | Contact form + campus info |
| Default Page | `page.php` | Standard page with content |

## Theme Customization

### Colors
The theme uses CSS custom properties. To customize, edit `style.css` and modify the `:root` variables:

```css
:root {
    --primary: #077E86;
    --primary-light: #2A7970;
    --secondary: #CF5E1C;
    --accent: #FD6406;
    --midnight: #172566;
}
```

### Logo
1. Go to **Appearance > Customize > Site Identity**
2. Upload your custom logo
3. The theme will use it in the header

### Fonts
The theme uses Arial/Helvetica by default. To change fonts:
1. Edit `style.css`
2. Update the `font-family` in the `*` selector
3. Or enqueue Google Fonts in `functions.php`

## Technical Architecture

### Laravel → WordPress Mapping

| Laravel | WordPress |
|---------|-----------|
| `app.blade.php` layout | `header.php` + `footer.php` + `front-page.php` |
| `@yield('content')` | `the_content()` loop |
| `@include('partials/header')` | `templates/header-main.php` |
| `@include('partials/footer')` | `templates/footer-main.php` |
| `asset()` | `get_template_directory_uri()` |
| `route('home')` | `home_url('/')` |
| `$settings` model | Theme Customizer (`get_theme_mod()`) |
| `Course` model | `course` CPT |
| `Event` model | `event` CPT |
| Blade `@foreach` | `WP_Query` loops |

### File Structure

```
fusion-college/
├── 404.php                 # 404 error page
├── archive-course.php      # Course archive listing
├── archive-event.php       # Event archive listing
├── comments.php            # Comments template
├── footer.php              # Footer wrapper
├── front-page.php          # Homepage template
├── functions.php           # Theme setup, CPTs, menus
├── header.php              # Header wrapper
├── index.php               # Fallback template
├── page-admissions.php     # Admissions page template
├── page-contact.php        # Contact page template
├── page-courses.php        # Courses page template
├── page-events.php         # Events page template
├── page.php                # Default page template
├── search.php              # Search results
├── searchform.php          # Search form
├── single-course.php       # Single course detail
├── single-event.php        # Single event detail
├── single.php              # Default single post
├── style.css               # Main stylesheet (all CSS)
├── css/                    # Additional CSS (if needed)
├── images/                 # Theme images
├── inc/
│   ├── acf-field-groups.php    # ACF field config
│   ├── demo-data-seeder.php    # Demo data importer
│   ├── nav-walker.php          # Custom nav walker
│   └── template-functions.php  # Helper functions
├── js/
│   └── main.js             # Theme JavaScript
└── templates/
    ├── course-card.php         # Course card partial
    ├── event-card.php          # Event card partial
    ├── footer-main.php         # Footer content
    ├── header-main.php         # Header content
    ├── mobile-menu.php         # Mobile menu
    └── toast.php               # Toast notification
```

## Support

For questions or issues with the theme:
1. Check this README
2. Review the WordPress theme customizer options
3. Verify ACF is installed if flexible content fields are missing
4. Flush permalinks: Settings > Permalinks > Save Changes

## Credits

Converted from the Fusion College of Technology Laravel application. All design and CSS preserved from the original Laravel UI.

## License

GNU General Public License v2 or later
