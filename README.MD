# WordPress Starter Plugin
### A great framework that makes WordPress plugin development easier!

---
Before creating your first **WPSP** project, make sure you have the following applications installed on your local computer:

- PHP: **^8.2**
- PHP CLI: **^8.2**
- Composer
- Nodejs
- A WordPress website running on version **6.1 or higher**

> [!CAUTION]
> Please pay attention to whether the PHP version and PHP CLI running are suitable for the project WPSP will develop or not?!

After installing the above applications, go to the directory: `/wp-content/plugins` of the Website (A) to initialize a new WPSP project via the following Composer command:

```
composer create-project oceancodex/wpsp my-new-plugin
```

The plugin project with the folder name `my-new-plugin` will be initialized and the dependencies will be downloaded.

Then, run the commands below to install the complete project:

```
cd my-new-plugin
```

```
php bin/install
```

The installer will ask you for some project information, fill in that information like the following example:

- **Project name:** Project name `(eg: My New Plugin)`
- **Project short name:** Short project name `(eg: mnp)`
- **Root namespace:** Namespace of the project `(eg: MyNewPlugin)`
- **Prefix for environment key:** Prefix for variables in the .env file `(eg: MNP_)`
- **Text domain:** Text domain used for translation according to WordPress standards `(eg: my-new-plugin)`

> [!IMPORTANT]
> The above information must be declared correctly in writing style, uppercase and lowercase as in the example for the project to work best.\
> Declare the above information to limit plugin conflicts and create an independent operating environment for each project using WPSP running on the same website.

The installer will automatically set up the project, installing dependencies.

If not, you can manually run the following commands to complete project setup:

```
composer update
```

```
npm install
```

```
npm run mix-production
```

That's it, you've completed setting up a new plugin project based on WPSP.

Go to the Plugins menu in `/wp-admin` to activate your: `My New Plugin` plugin.
___
Docs: https://docs.oceancodex.com/tai-lieu/wordpress-starter-plugin

OCEANCODEX.COM