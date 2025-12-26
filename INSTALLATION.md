# Tether BBCode System - Installation Guide

## Overview

This XenForo 2.2.8 Patch 1 addon provides a comprehensive tether management system with BBCode integration. Users can use BBCode to display tethers with positive and negative effects, which open in a popup when clicked.

## Features

- **Custom BBCode Tag**: `[tether=identifier]positive1,negative5[/tether]`
- **Database Management**: Store tether data with categories, tags, and effects
- **Admin Panel**: Full CRUD operations for managing tethers
- **Popup Display**: Click on tether images to view detailed information
- **Effect Highlighting**: Automatically highlights unlocked positive/negative effects
- **Five Categories**: Eater, Death, God, Entity, Dedication

## Installation

### Method 1: Upload Addon Files (Recommended)

1. **Upload the addon directory** to your XenForo installation:
   ```
   Copy: src/addons/Miatoro/Tether
   To: /path/to/your/xenforo/src/addons/Miatoro/Tether
   ```

2. **Navigate to Admin Control Panel** → Add-ons → Install add-on

3. **Install from archive** or **Install from directory**:
   - If using directory: Enter `Miatoro/Tether`
   - If using archive: Upload the ZIP file of the Miatoro directory

4. **Complete the installation** - The setup will automatically:
   - Create the `xf_miatoro_tether` database table
   - Register the BBCode tag
   - Set up routes and admin navigation

### Method 2: Manual Installation

If you need to install manually or customize the installation:

1. **Database Setup**:
   - The database table will be created automatically during installation
   - Table name: `xf_miatoro_tether`

2. **BBCode Registration**:
   - Go to Admin CP → Content → BB codes
   - The BBCode should already be registered as `[tether]`
   - If not, manually create it with these settings:

   **BB code tag**: `tether`

   **Replacement mode**: PHP callback

   **Supports option parameter**: Yes

   **PHP callback**: `Miatoro\Tether\BbCode\Tag\Tether::render`

   **Option match regular expression**: `#^[a-zA-Z0-9_-]+$#`

   **Editor icon**: Font Awesome icon - `fa-link`

   **Allow this BB code in signatures**: Yes

3. **Template Modifications** (if templates are not auto-imported):

   You need to manually add the following templates in Admin CP → Appearance → Templates:

   **Admin Templates:**
   - `miatoro_tether_list` - List all tethers
   - `miatoro_tether_edit` - Add/edit tether form
   - `miatoro_tether_delete` - Delete confirmation

   **Public Templates:**
   - `miatoro_tether_bbcode` - BBCode rendering output
   - `miatoro_tether_popup` - Popup overlay
   - `miatoro_tether_js` - JavaScript handler
   - `miatoro_tether.less` - CSS styles

   Copy the content from the files in `src/addons/Miatoro/Tether/_output/templates/`

4. **Include JavaScript and CSS**:

   Add a template modification to include the JavaScript:

   **Template**: `PAGE_CONTAINER`

   **Find**: `</body>`

   **Action**: Replace with:
   ```html
   <xf:include template="miatoro_tether_js" />
   </body>
   ```

   Add a template modification to include the CSS:

   **Template**: `PAGE_CONTAINER`

   **Find**: `<xf:head />`

   **Action**: Replace with:
   ```html
   <xf:head />
   <xf:css src="miatoro_tether.less" />
   ```

## Configuration

### Adding Your First Tether

1. Navigate to **Admin CP** → **Content** → **Manage Tethers**

2. Click **Add Tether**

3. Fill in the form:
   - **Identifier**: Unique ID (e.g., `arachnas-swansong`)
   - **Title**: Display name (e.g., `Arachna's Swansong`)
   - **Category**: Choose from Eater, Death, God, Entity, or Dedication
   - **Tags**: Comma-separated (e.g., `Spider, Venom, Psychological`)
   - **Wiki URL**: Link to more information
   - **Image Path**: Path to tether image (e.g., `/db/tethers/arachnas-swansong.webp`)
   - **Description**: Main description text
   - **Negative 1-7**: Deepen effects (negative progression)
   - **Positive 1-7**: Mend effects (positive progression)

4. Click **Save**

### Image Setup

Images should be placed in your XenForo installation's public directory:

**Default path structure**:
```
/public_html/db/[identifier].webp
```

**Custom path** (if specified in Image Path field):
```
/public_html/db/tethers/[identifier].webp
```

**Recommended image specs**:
- Format: WebP (for best compression)
- Max dimensions: 100x100px (for BBCode display)
- Larger images for popup: 500x500px or similar

## Usage

### For Forum Users

Users can add tethers to their posts using the BBCode syntax:

```
[tether=arachnas-swansong]positive1,negative5[/tether]
```

**Parameters**:
- `arachnas-swansong` = The tether identifier
- `positive1` = Current positive level unlocked
- `negative5` = Current negative level unlocked

**Multiple tethers**:
```
[tether=name-of-tether]positive1,negative5[/tether]
[tether=name-of-tether2]positive1,negative1[/tether]
[tether=name-of-tether3]positive2,negative3[/tether]
```

### For Administrators

**Managing Tethers**:
1. Admin CP → Content → Manage Tethers
2. Use the list to view all tethers
3. Click **Edit** to modify a tether
4. Click **Delete** to remove a tether

**Viewing Tether Usage**:
- Search for tether BBCode in posts
- Monitor which tethers are most popular

## Database Structure

The addon creates one table: `xf_miatoro_tether`

**Columns**:
- `tether_id` (INT, Primary Key, Auto Increment)
- `identifier` (VARCHAR 100, Unique)
- `title` (VARCHAR 255)
- `category` (VARCHAR 50)
- `tags` (TEXT)
- `wiki_url` (VARCHAR 500)
- `image_path` (VARCHAR 500)
- `description` (TEXT)
- `negative_1` through `negative_7` (TEXT)
- `positive_1` through `positive_7` (TEXT)
- `created_date` (INT)
- `modified_date` (INT)

## Customization

### Styling

Edit the `miatoro_tether.less` template to customize:
- Tether image size and hover effects
- Popup appearance
- Active effect highlighting
- Colors and spacing

### Effect Levels

The addon supports levels 1-7 for both positive and negative effects. You can:
- Leave levels empty if not needed
- Add more levels by modifying the database schema and templates
- Customize level names in phrases

### Categories

Default categories: Eater, Death, God, Entity, Dedication

To add more categories, edit:
1. `Entity/Tether.php` - Update `allowedValues` in structure
2. `Repository/Tether.php` - Add to `getCategoryList()`

## Troubleshooting

### BBCode not working
- Check that the BBCode is registered in Admin CP → Content → BB codes
- Verify the callback class and method are correct
- Clear XenForo cache: Admin CP → Tools → Rebuild caches

### Images not displaying
- Verify image path is correct
- Check file permissions on the `/db/` directory
- Ensure WebP images are supported by your server

### Popup not opening
- Check that JavaScript is included in templates
- Verify browser console for errors
- Ensure XenForo's overlay system is working

### Admin panel not showing
- Rebuild admin navigation: Admin CP → Tools → Rebuild caches
- Check addon is enabled: Admin CP → Add-ons
- Verify admin route is registered

## Upgrade

To upgrade to a newer version:

1. **Backup your database** (especially `xf_miatoro_tether` table)
2. **Backup addon files**
3. **Upload new files** to overwrite existing
4. **Run upgrade**: Admin CP → Add-ons → Upgrade
5. **Clear caches**: Admin CP → Tools → Rebuild caches

## Uninstallation

To uninstall the addon:

1. **Export your tether data** if you want to keep it:
   ```sql
   SELECT * FROM xf_miatoro_tether;
   ```

2. **Uninstall via Admin CP**: Add-ons → Tether BBCode System → Uninstall

3. **Confirm data deletion** - This will:
   - Drop the `xf_miatoro_tether` table
   - Remove the BBCode registration
   - Remove all templates and routes

**Note**: Existing posts with tether BBCode will show the raw BBCode after uninstallation.

## Support

For issues, questions, or feature requests:
- Check the installation steps again
- Review the troubleshooting section
- Check XenForo error logs: Admin CP → Tools → Server error log

## Credits

- **Addon**: Tether BBCode System
- **Version**: 1.0.0
- **Compatible with**: XenForo 2.2.8 Patch 1
- **Author**: Miatoro

## License

This addon is provided as-is for use with XenForo installations.
