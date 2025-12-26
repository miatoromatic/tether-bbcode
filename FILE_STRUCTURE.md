# File Structure - Tether BBCode System

Complete file listing for the XenForo Tether BBCode addon.

## Root Documentation Files

```
/
├── README.md                          # Main documentation and feature overview
├── INSTALLATION.md                    # Detailed installation instructions
├── QUICKSTART.md                      # 5-minute quick start guide
├── TEMPLATE_MODIFICATIONS.md          # Template modification guide
├── FILE_STRUCTURE.md                  # This file - complete file listing
└── example_tether_data.sql            # Sample SQL data for testing
```

## Addon Files

### Core Files

```
src/addons/Miatoro/Tether/
├── addon.json                         # Addon metadata and version info
└── Setup.php                          # Install/Upgrade/Uninstall logic
```

**addon.json**
- Defines addon ID, version, and requirements
- Specifies XenForo 2.2.8+ requirement

**Setup.php**
- Creates `xf_miatoro_tether` database table
- Registers BBCode on install
- Handles clean uninstall

### Controllers

```
src/addons/Miatoro/Tether/
├── Admin/Controller/
│   └── Tether.php                     # Admin CRUD operations
└── Pub/Controller/
    └── Tether.php                     # Public popup display
```

**Admin/Controller/Tether.php**
- `actionIndex()` - List all tethers
- `actionAdd()` - Show add form
- `actionEdit()` - Show edit form
- `actionSave()` - Save tether data
- `actionDelete()` - Delete confirmation and execution

**Pub/Controller/Tether.php**
- `actionView()` - Display popup with tether details
- Handles AJAX requests from frontend

### BBCode Handler

```
src/addons/Miatoro/Tether/
└── BbCode/Tag/
    └── Tether.php                     # BBCode parsing and rendering
```

**BbCode/Tag/Tether.php**
- `render()` - Main rendering function
- `parseValues()` - Parses positive/negative values
- Outputs HTML via template or plain text

### Data Layer

```
src/addons/Miatoro/Tether/
├── Entity/
│   └── Tether.php                     # Database entity model
└── Repository/
    └── Tether.php                     # Data access layer
```

**Entity/Tether.php**
- Defines database structure
- Getters: `getNegativeValues()`, `getPositiveValues()`, `getTagsArray()`
- Validation and save hooks

**Repository/Tether.php**
- `findTethersForList()` - Get all tethers
- `getTetherByIdentifier()` - Get by identifier
- `getTetherById()` - Get by ID
- `findTethersByCategory()` - Filter by category
- `getCategoryList()` - Available categories

### Templates

#### Admin Templates

```
src/addons/Miatoro/Tether/_output/templates/admin/
├── miatoro_tether_list.html           # Tether list view
├── miatoro_tether_edit.html           # Add/Edit form
└── miatoro_tether_delete.html         # Delete confirmation
```

**miatoro_tether_list.html**
- Displays all tethers in a structured list
- Edit/Delete buttons for each tether
- "Add Tether" button

**miatoro_tether_edit.html**
- Form for creating/editing tethers
- All fields including negative/positive 1-7
- Category dropdown, tag input

**miatoro_tether_delete.html**
- Confirmation dialog for deletion
- Shows tether title

#### Public Templates

```
src/addons/Miatoro/Tether/_output/templates/public/
├── miatoro_tether_bbcode.html         # BBCode rendering
├── miatoro_tether_popup.html          # Popup overlay content
├── miatoro_tether_js.html             # JavaScript handler
└── miatoro_tether.less                # CSS/LESS styles
```

**miatoro_tether_bbcode.html**
- Renders the tether image
- Adds data attributes for popup
- Handles missing tethers

**miatoro_tether_popup.html**
- Popup content with tether details
- Shows category, tags, description
- Lists negative/positive effects
- Highlights active effects

**miatoro_tether_js.html**
- XenForo element handler
- Click event listener
- AJAX popup loading

**miatoro_tether.less**
- Tether image styling
- Hover effects
- Popup styling
- Active effect highlighting

### Routes

```
src/addons/Miatoro/Tether/_output/routes/
├── admin/
│   └── tethers.json                   # Admin route: /admin.php?tethers/
└── public/
    └── tether.json                    # Public route: /tether/
```

**admin/tethers.json**
- Maps to `Miatoro\Tether:Tether` admin controller
- Format: `:int<tether_id,tether_id>/:action`
- Handles: list, add, edit, save, delete

**public/tether.json**
- Maps to `Miatoro\Tether:Tether` public controller
- Used for popup AJAX requests

### Admin Navigation

```
src/addons/Miatoro/Tether/_output/admin_navigation/
└── miatoro_tether.json                # Admin menu entry
```

**miatoro_tether.json**
- Adds "Manage Tethers" to Content menu
- Icon: fa-link
- Links to admin tethers route

### Phrases (Internationalization)

```
src/addons/Miatoro/Tether/_output/phrases/
├── _metadata.json                     # Phrase metadata
├── miatoro_tether_add_tether.txt
├── miatoro_tether_category.txt
├── miatoro_tether_confirm_delete.txt
├── miatoro_tether_deepen_effects.txt
├── miatoro_tether_deepen_level.txt
├── miatoro_tether_delete_tether.txt
├── miatoro_tether_description.txt
├── miatoro_tether_edit_tether.txt
├── miatoro_tether_identifier.txt
├── miatoro_tether_identifier_explain.txt
├── miatoro_tether_image_path.txt
├── miatoro_tether_image_path_explain.txt
├── miatoro_tether_manage_tethers.txt
├── miatoro_tether_mend_effects.txt
├── miatoro_tether_mend_level.txt
├── miatoro_tether_negative_effects.txt
├── miatoro_tether_negative_x.txt
├── miatoro_tether_no_tethers_defined.txt
├── miatoro_tether_not_found.txt
├── miatoro_tether_positive_effects.txt
├── miatoro_tether_positive_x.txt
├── miatoro_tether_tags.txt
├── miatoro_tether_tags_explain.txt
├── miatoro_tether_title.txt
├── miatoro_tether_view_wiki.txt
└── miatoro_tether_wiki_url.txt
```

All phrases are in English. Can be translated via XenForo's phrase system.

## Database Schema

### Table: xf_miatoro_tether

Created by `Setup.php` during installation.

**Columns:**
- `tether_id` - INT, Primary Key, Auto Increment
- `identifier` - VARCHAR(100), Unique
- `title` - VARCHAR(255)
- `category` - VARCHAR(50)
- `tags` - TEXT
- `wiki_url` - VARCHAR(500)
- `image_path` - VARCHAR(500)
- `description` - TEXT
- `negative_1` through `negative_7` - TEXT
- `positive_1` through `positive_7` - TEXT
- `created_date` - INT (Unix timestamp)
- `modified_date` - INT (Unix timestamp)

**Indexes:**
- Primary key on `tether_id`
- Unique key on `identifier`
- Key on `category`

## File Count Summary

```
Total PHP Files:        6
Total Template Files:   7
Total Route Files:      2
Total Phrase Files:     27
Total Config Files:     2 (addon.json + admin_navigation)
Total Documentation:    5
Total SQL Files:        1

Grand Total:           50 files
```

## Installation Paths

### XenForo Installation
Copy `src/addons/Miatoro/Tether/` to:
```
/path/to/xenforo/src/addons/Miatoro/Tether/
```

### Image Directory (Optional)
Create for tether images:
```
/path/to/xenforo/public_html/db/
/path/to/xenforo/public_html/db/tethers/
```

Default image path: `/db/{identifier}.webp`
Custom path: As specified in each tether's settings

## File Permissions

Recommended permissions:
```
Directories:  755 (rwxr-xr-x)
PHP Files:    644 (rw-r--r--)
Templates:    644 (rw-r--r--)
JSON Files:   644 (rw-r--r--)
Image Dir:    755 with write access for upload
```

## Dependencies

### XenForo Core Dependencies
- XF:BbCode (BBCode system)
- XF:Entity (Database entities)
- XF:Repository (Data access)
- XF:Controller (MVC controllers)
- XF:Mvc (MVC framework)

### No External Dependencies
This addon uses only XenForo's built-in systems. No external libraries required.

## Browser Requirements

### JavaScript
- Modern browser with ES5+ support
- jQuery (included with XenForo)
- XenForo's Element handler system

### CSS
- LESS compilation (handled by XenForo)
- CSS3 support for animations and effects

## Version History

### Version 1.0.0 (Current)
- Initial release
- All features implemented
- Full documentation

## Future File Additions

Potential additions in future versions:
- `Cron/` - Scheduled tasks
- `Job/` - Background jobs
- `Listener/` - Event listeners
- `Permission/` - Permission system
- `Widget/` - Widget support
- `Api/` - REST API endpoints
- `Import/` - Data import/export

## Notes

- All files use UTF-8 encoding
- Line endings: LF (Unix style)
- Indentation: Tabs for PHP, spaces for templates
- Coding standard: XenForo 2.x standards
- Template syntax: XenForo template syntax

---

Last updated: December 2024
