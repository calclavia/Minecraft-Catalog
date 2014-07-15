=== Minecraft Item Library ===
Contributors: alieneila
Donate link: http://www.alieneila.net/
Tags: minecraft, items, recipes
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the ability to create a Minecraft item/block/recipe/monster library using custom post types.

== Description ==

View the **Other Notes** tab for more detailed instructions.

**Note** Having issues getting screenshots to load on the screenshots tab, hopefully they'll be up soon.

This plugin adds the ability to create a library of Minecraft items/blocks/recipes/monsters etc.

Option to auto insert item information, or shortcodes are available.

1. [mcitem-recipe] - Inserts a crafting table that will display what items are needed to craft the current item.
1. [mcitem-stats] - Inserts a table listing the stats of the item such as Points of Protection, Health, Durability, etc...
1. [mcitem-sources] - Inserts a table with mini-item images of the item/monster that the current item comes from.

On the custom post type edit page, there are 3 boxes:

1) Minecraft Stats - The following fields are available:

* Block/Item ID: Minecraft Item or Block ID	
* Stack Count: If stackable, how many per stack?	
* Health: How much health does the monster or critter have?
* Heals For: How much health is returned when used?
* Damages For: How much damage is done when used?
* Points of Protection: How many points of protection does the item give? (Max 10)
* Attack Strength: How much is the attack strength?
* Durability: How much durability does the item have?
* Hunger Restoration: How much hunger is restored? (Usually a max of 6)

2) Source Options - Provides drop down boxes of items/monsters that have been assigned as a Source.

3) Craftable Options

* Drop down selection of items assigned as a Crafting Station (ie. Crafting Table, Furnace)
* # of items that are crafted at a time.
* Up to 9 slots used with drop downs of items assigned as a Material.
* Format of recipe table of which 3 are available, Crafting Table, Furnace and Brewing.

28 MC Item (a custom taxonomy) Categories are automatically created when the plugin is activated. These are used for sorting just like post categories and can be added to menus in Wordpress's built in menu system.

Only 4 of these are required for the plugin to work.

* Craftable
* Material
* Crafting Station
* Source

The others you can create/add/delete as you see fit.

**Note** When the plugin is first activated, the 5 parent categories will show up in Minecraft Item > MC Categories. The other 23 will be there, but for some reason they will not show up there. To fix this, simply add another MC Category then go back to the MC Categories (since new ones are added via ajax) and the children will show up. Then you can just delete the new one you created. Not sure if this is a bug in Wordpress or if it's something I am doing wrong.

== Installation ==

1. Upload the contents of the zip file to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

or

1. Go to Plugins in the dashboard
1. Click Add New
1. Use the upload feature and upload the zip file. Wordpress will auto install the plugin.

or

1. Go to Plugins in the dashboard
1. Click Add New
1. Search for Minecraft Item Library
1. Install

== Frequently Asked Questions ==

= Have a question? =

Post it in the Wordpress support forum for this plugin.

== Screenshots ==

1. New MC Item custom post type (View the Other Notes tab for following screenshots)
2. Entering the Cow critter as a Source
3. Cow stats
4. Milk Item ID
5. Cake Item as Craftable and Food
6. Cake crafting options
7. Viewing the Cake post

== Changelog ==

= 1.1 =
* Fixed auto inserting MC Categories on Plugin activation.

= 1.0 =
* Initial Launch

== Upgrade Notice ==

None at this time.

== Instructions ==

**Note** To get the crafting table, item stats, and sources table to display when viewing the item, you need to either turn on the Auto Insert options, or enter the shortcodes on the item page.

If you just wanted to have a library of items without using the craftable options, or displaying the source of items, then all you need to do is create a new MC Item, enter the title, description, excerpt if your theme supports excerpts, and categorize it. You could also just use the stats block.

However, if you want to use the full functionality, displaying the recipes for how to create items, the source of raw materials, etc... you need to start with the sources and then build up to the final item. I highly suggest the first 3 items you add are the Crafting Stations... Crafting Table, Furnace, and the Brewing stand. You don't need to add their recipe to make them yet, but they are required for crafting all of the craftable items. Just enter the title, description, add a featured image, and assign them to the Crafting Station category. You can come back later to add their recipe for how to build them.

On to the cake!

Cake requires Milk which comes from a Cow, Sugar which comes from Sugar Cane, an Egg from a Chicken, and Wheat which can be grown.

**Note** Once you've added an item you can reuse it in other recipes, so once you get more and more of the raw materials entered, this process becomes easier since you're not entering every single item anew.

So for creating a cake, we would first enter the Cow. Add a new MC Item, Cow as title, description as you see fit, add the Cow to the Source category and to the Critters category. We add it to the Source category to mark it is as useable in other items as a source... such as Milk and Leather. You can then scroll down and also enter the Health of the cow, which is 10. For the icons to display, add a featured image. The icon sizes used are 50 x 50 px, you can add any size image and a 50 x 50 px image will automatically be generated via Wordpress's built in cropping/thumbnail system.

Now we are done with the cow, go ahead and publish.

Next we will add Milk, follow the same steps as above except for the following... For categories we want to add it to Material. We add it to Material so that it can be used as a material in the crafting options and will display in the drop downs for the slots. Then if you keep the categories that are default, enter it into the Food child category under the Item Library parent category.

(Optional) Scroll down and enter the minecraft item ID if you'd like. You can obtain the item ID from minecraftwiki.net or mincraftopia.com

Now in the Source option block, choose Cow from the drop down menu. You can add more sources by clicking the link below the drop down.

We are done with the milk, so you can Publish.

Do the same for the rest of the ingredients, adding thier sources and information. Some items have stats which you can enter into the Minecraft Stats.

Now for the cake! The entry is the same as above with a couple differences. For the cake we use the Crafting Options. Add the Cake to the Craftable category, then scroll down to the Craftable Options block.

Here you will see a drop down of the crafting stations, an input box to mark how many of an item are crafted, and up to 9 slots to enter items. Since in Minecraft you need to put certain items in certain slots in order for the outcome to be what you expect. If you added all of the materials used for crafting a cake, you can select them in each slot. The format options to the right are for the different crafting formats available. By choosing which format, the recipe on the item page will display using that format. For a cake, it uses a crafting table, so you would use format 1.

After all of the options are set, you can publish your cake and view it to see how it looks.

You can view screenshots of what was just gone over on the Screenshots tab.