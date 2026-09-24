# Vuetify Core

This repo holds a base theme which holds basic structure for building Vuetify based themes. 

## Installation
First of all, you need to have WebFiori framework installed. After that, include the following in your `require` section of your `composer.json` file: `webfiori/vuetifyCore`. Then run the command `php composer "install" "--no-dev"` to install your dependencies. 

## Classes 

### [`VuetifyThemeCore`](https://github.com/WebFiori/vuetifyCore/blob/main/themes/vuetifyCore/VuetifyThemeCore.php)
This is the theme class. It acts as the core of any Vuetify based theme. The developer must extend this class in order to create his own Vuetify based themes.

### [`VuetifyWebPage`](https://github.com/WebFiori/vuetifyCore/blob/main/themes/vuetifyCore/VuetifyWebPage.php)
This class extends the class `WebPage`. It has utility methods which helps in creating pages which is based on Vuetify much easier task.

### [`CreateVuetifyThemeCommand`](https://github.com/WebFiori/vuetifyCore/blob/main/themes/vuetifyCore/cli/CreateVuetifyThemeCommand.php)
A CLI command that can be registered to create Vuetify theme wireframes. This command can be registered in the class `InitCLICommands` of your application.
