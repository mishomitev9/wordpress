When you preapre a new localhost setup or refresh an existing one, make sure you'll follow the tips and tricks and steps from this article [Prepare localhost Setup Details](https://devrixverse.com/knowledgebase/prepare-localhost-setup-details/)


***As a PO, make sure you'll update this.*** and delete it 😜




# Project Name

A short description of the project.

## Notes
Make sure to list all specific project notes, such as important plugins, something unusual for the setup and the like.
Explain the structure of the project - a WordPress Multisite, a WordPress single site, etc.

Below you'll find important notes about the project, the git branching and the like.

#### Documentation
You should have a URL to the project documentation in [Asana task with the Setup Details here](Asana task URL here).
For any other development related information, check the Git repository's Wiki page for tips and tricks or sync with the Project Owner of the project.

#### Localhost Project URL
Make sure to update your hosts/server config to match the custom URL we use for the project - `local.domain.com`. For information on how to do it [read our article](https://devrixverse.com/knowledgebase/setup-a-custom-localhost-url/)  
***As a PO, make sure you'll update this.***

#### Dashboard/Admin access
For localhost Dashboard access, you can use `admin/admin` for `username/password`. Don't judge, this is for your localhost :)
If you have WP-CLI, you can use [wp user create](https://wp-cli.org/commands/user/create/) or simply add a new user from your phpMyAdmin and/or your local MySQL and use another set of creditentials.    
***As a PO, make sure you'll update this.***

#### Recommended plugins and plugins notes

* Plugin Name 01 - descritpion
* Plugin Name 02 - descritpion
* Plugin Name 03 - descritpion

***As a PO, make sure you'll update this.***

#### More details

* [Git: DevriX Git Branching Model/Git Flow](https://devrixverse.com/knowledgebase/git-devrix-git-branching-model-git-flow/)  
* [WordPress localhost debugging](https://devrixverse.com/knowledgebase/wordpress-localhost-debugging/).
* [BE Media from Production](https://devrixverse.com/knowledgebase/be-media-from-production/)
* [A typical Git structure](https://devrixverse.com/knowledgebase/a-typical-git-structure)

---

## Setup Details
The Git repository contains a few root files and the `wp-content` directory content, so we are going to setup the project following the steps below.

The steps below are valid for a simple project. If your project requires additiona steps, such as having a custom Apache/hosts setup, make sure you'll add them.  
***As a PO, make sure you'll update this.***

### 1) Clone the repository
Navigate to your local webserver folder - `www/html`, `htdocs`, etc, based on your OS. Make sure the directory is writable. Again, this is based on your localhost setup and personal preferences.

Clone the Git repository with the with the following command: `git clone git@bitbucket.org:devrix/<project-name-here>.git`.  
***As a PO, make sure you'll update this.***

### 2) Download WordPress
Navigate to the repository folder that git just created. 

Run `wp core download --skip-content --force`. You can add `--version=XXXX` if the project requires a specific version of WordPress Core.    
***As a PO, make sure you'll update this.***

The final goal is to have all Git repository files into your root directory, which includes `.git`, `.gitignore`, `wp-content` and everything else, based on the project needs.

Make sure the directory is writable. Again, this is based on your localhost setup and personal preferences.

### 3) Create a wp-config.php file
In the repository you'll find `wp-config-local-sample.php`. Duplicate the file and name it `wp-config.php`. Enter your localhost the atabase user and password and the database name inside the file. You'll see the `define` variables.

As a PO, make sure to set the proper `$table_prefix` into the config file.  
If the project is a multisite, make sure you'll uncomment and update the define variables.         
***As a PO, make sure you'll update this.***

### 4) Create and import the database
**Standard method:**

Create an empty database on your localhost database server and set `utf8mb4_general_ci` for the DB collation. Download the database from [<Project Name> Project Setup, Git Details, Database dump and Media export](asana-task-url-here) and import the downloaded database into the newly created database. This depends on your localhost setup.

**WP-CLI method:**

Run `wp db create` to create a new database. Then run `wp db import <sql-path>` and ths should be it!

### 4) Access the site
Once the database is imported you'll have [http://local.project-domain-name/](http://local.project-domain-name/) ready to use.       
***As a PO, make sure you'll update this.***

### 5) Reset permalinks

Go do to the `Dashboard > Settings > Permalinks` and click on Save button. In that way, you'll generate a new `.htaccess` file, so you'll have working pretty permalinks.

Make sure the directory is writable, so WordPress can generate the new file.

As stated above, We strongly suggest you to enable the `WP_DEBUG` on your localhost. You can check **Localhost Debugging** section for more details.

If you have any questions regarding the setup, feel free to ask in project's Slack channel!
