# Tether BBCode System for XenForo 2.2.8

A comprehensive XenForo addon that allows users to manage and display a tether system using custom BBCode with dynamic popups.

## Overview

This addon enables forum users to embed tethers in their posts using a custom BBCode tag. Each tether can have positive (Mend) and negative (Deepen) effects that are tracked and displayed. When users click on a tether image, a popup displays detailed information including unlocked effects.

## Key Features

- ✅ **Custom BBCode**: `[tether=identifier]positive1,negative5[/tether]`
- ✅ **Database-Driven**: Store unlimited tethers with full CRUD operations
- ✅ **Admin Panel**: Easy-to-use interface for managing tethers
- ✅ **Dynamic Popups**: Click tether images to view detailed information
- ✅ **Effect Tracking**: Automatically highlights unlocked positive/negative effects
- ✅ **Categories**: Organize tethers into Eater, Death, God, Entity, or Dedication
- ✅ **Tags System**: Add searchable tags to each tether
- ✅ **Wiki Integration**: Link tethers to external wiki pages
- ✅ **Responsive Design**: Mobile-friendly popup and image display

## Example Usage

### BBCode in Posts

```
[tether=arachnas-swansong]positive1,negative4[/tether]
```

This displays the tether image and tracks that the user has unlocked:
- Positive level 1 (Mend I)
- Negative level 4 (Deepen IV)

### Multiple Tethers

```
[tether=arachnas-swansong]positive1,negative5[/tether]
[tether=shadow-binding]positive1,negative1[/tether]
[tether=void-whisper]positive2,negative3[/tether]
```

Creates a row of clickable tether images.

## Installation

See [INSTALLATION.md](INSTALLATION.md) for detailed installation instructions.

**Quick Start**:
1. Upload `src/addons/Miatoro/Tether` to your XenForo installation
2. Install via Admin CP → Add-ons
3. Configure your first tether via Admin CP → Content → Manage Tethers

## File Structure

```
src/addons/Miatoro/Tether/
├── addon.json                          # Addon metadata
├── Setup.php                           # Install/Upgrade/Uninstall logic
├── Admin/
│   └── Controller/
│       └── Tether.php                  # Admin CRUD operations
├── BbCode/
│   └── Tag/
│       └── Tether.php                  # BBCode parsing and rendering
├── Entity/
│   └── Tether.php                      # Database entity model
├── Pub/
│   └── Controller/
│       └── Tether.php                  # Public popup controller
├── Repository/
│   └── Tether.php                      # Data access layer
└── _output/
    ├── admin_navigation/               # Admin menu entries
    ├── phrases/                        # Language phrases
    ├── routes/                         # Route definitions
    └── templates/
        ├── admin/                      # Admin templates
        │   ├── miatoro_tether_list.html
        │   ├── miatoro_tether_edit.html
        │   └── miatoro_tether_delete.html
        └── public/                     # Public templates
            ├── miatoro_tether_bbcode.html
            ├── miatoro_tether_popup.html
            ├── miatoro_tether_js.html
            └── miatoro_tether.less
```

## Database Schema

**Table**: `xf_miatoro_tether`

| Column | Type | Description |
|--------|------|-------------|
| tether_id | INT | Primary key, auto-increment |
| identifier | VARCHAR(100) | Unique identifier (e.g., "arachnas-swansong") |
| title | VARCHAR(255) | Display name |
| category | VARCHAR(50) | Eater, Death, God, Entity, or Dedication |
| tags | TEXT | Comma-separated tags |
| wiki_url | VARCHAR(500) | Link to wiki page |
| image_path | VARCHAR(500) | Path to tether image |
| description | TEXT | Main description |
| negative_1 to negative_7 | TEXT | Deepen effects (levels 1-7) |
| positive_1 to positive_7 | TEXT | Mend effects (levels 1-7) |
| created_date | INT | Unix timestamp |
| modified_date | INT | Unix timestamp |

## API / Code Examples

### Get a Tether by Identifier

```php
$tetherRepo = \XF::repository('Miatoro\Tether:Tether');
$tether = $tetherRepo->getTetherByIdentifier('arachnas-swansong');

if ($tether) {
    echo $tether->title;
    echo $tether->description;
}
```

### Get All Tethers

```php
$tetherRepo = \XF::repository('Miatoro\Tether:Tether');
$tethers = $tetherRepo->findTethersForList()->fetch();

foreach ($tethers as $tether) {
    echo $tether->title . "\n";
}
```

### Get Tethers by Category

```php
$tetherRepo = \XF::repository('Miatoro\Tether:Tether');
$deathTethers = $tetherRepo->findTethersByCategory('Death')->fetch();
```

### Create a New Tether

```php
$tether = \XF::em()->create('Miatoro\Tether:Tether');
$tether->identifier = 'example-tether';
$tether->title = 'Example Tether';
$tether->category = 'Death';
$tether->description = 'This is an example tether';
$tether->negative_1 = 'Deepen I: Example negative effect';
$tether->positive_1 = 'Mend I: Example positive effect';
$tether->save();
```

## Customization

### Adding More Effect Levels

Currently supports levels 1-7. To add more:

1. **Update Database Schema** in `Setup.php`:
   ```php
   $table->addColumn('negative_8', 'text')->nullable();
   $table->addColumn('positive_8', 'text')->nullable();
   ```

2. **Update Entity** in `Entity/Tether.php`:
   ```php
   'negative_8' => ['type' => self::STR, 'default' => ''],
   'positive_8' => ['type' => self::STR, 'default' => ''],
   ```

3. **Update Templates** to loop through 1-8 instead of 1-7

### Custom Categories

Edit `Entity/Tether.php` and `Repository/Tether.php`:

```php
// Entity/Tether.php
'allowedValues' => ['Eater', 'Death', 'God', 'Entity', 'Dedication', 'YourCategory', '']

// Repository/Tether.php
public function getCategoryList()
{
    return [
        'Eater' => 'Eater',
        'Death' => 'Death',
        'God' => 'God',
        'Entity' => 'Entity',
        'Dedication' => 'Dedication',
        'YourCategory' => 'Your Category'
    ];
}
```

### Styling

Edit `miatoro_tether.less` to customize:
- Image size: `.miatoro-tether-image { max-width: 100px; }`
- Hover effects: `.miatoro-tether:hover`
- Active effect highlighting: `.miatoro-tether-effect--active`
- Popup styling: `.miatoro-tether-popup-*`

## Requirements

- XenForo 2.2.8 Patch 1 or higher
- PHP 7.2 or higher
- MySQL 5.5 or higher

## Compatibility

- ✅ XenForo 2.2.8 Patch 1
- ✅ XenForo 2.2.x series (likely compatible)
- ❓ XenForo 2.3+ (not tested)

## Changelog

### Version 1.0.0 (Initial Release)
- Custom BBCode tag for tethers
- Admin panel for CRUD operations
- Database storage for tether data
- Dynamic popup display
- Effect highlighting system
- Categories and tags support
- Wiki integration

## Roadmap

Potential future features:
- [ ] Tether search/filter in admin panel
- [ ] User permission controls
- [ ] Import/export tether data
- [ ] Tether statistics and usage tracking
- [ ] Advanced image management
- [ ] Template conditional system for custom effects
- [ ] API endpoints for external integrations

## FAQ

**Q: Can users create their own tethers?**
A: No, only administrators can create and manage tethers via the Admin CP.

**Q: What if a tether doesn't have an image?**
A: The BBCode will still render, but the image will show as missing. It's recommended to always provide images.

**Q: Can I use this with XenForo 2.3?**
A: It should work, but it hasn't been tested. Try at your own risk.

**Q: How do I bulk import tethers?**
A: Currently, there's no built-in import feature. You can manually insert into the database or use the API to create tethers programmatically.

**Q: Can the popup be customized?**
A: Yes, edit the `miatoro_tether_popup.html` template and `miatoro_tether.less` styles.

## Support

For bug reports, feature requests, or questions:
1. Check the [INSTALLATION.md](INSTALLATION.md) guide
2. Review the FAQ above
3. Check XenForo error logs
4. Create an issue in your repository

## License

This addon is provided as-is. Please respect XenForo's license terms when using this addon.

## Credits

- Developed for XenForo 2.2.8 Patch 1
- Uses XenForo's built-in overlay and BBCode systems
- LESS styling with XenForo theme integration

---

**Made with ❤️ for the XenForo community**