## About

**switching.software** is a collection of ethical, easy-to-use and privacy-conscious alternatives to well-known software.

This site is only possible thanks to a few free and open projects:

- [switching.social](https://web.archive.org/web/20190915101437/https://switching.social/): The original site, that went offline in September 2019, but was restored [here](https://codeberg.org/swiso-en/archive)
- [Grav](https://getgrav.org/): A powerful file-based content management system
- [Codeberg.org](https://codeberg.org/): A non-profit and non-government organization, that gives our codebase a home - powered by [Gitea](http://gitlab.com/).

## License

[Switching.software](https://switching.software) is based on the work of [switching.social](https://web.archive.org/web/20190915101437/https://switching.social/). There has been a lot of adaptions since its shutdown in September 2019, but it still guides us.

All content was, is and will always be licensed as [CC BY-SA 4.0](https://creativecommons.org/licenses/by-sa/4.0/).

## Contribute

Currently, this project is in a very early stage of redesigning and reorganizing the codebase. So, there is no fixed process or similar stuff.

First Todo would be, to migrate every entry of every list on [switching.software](https://switching.software) - see [ticket #1](https://codeberg.org/swiso-en/website/issues/1).

## Local installation

Following steps should be done to create a fully-functional offline version of this website.

1. Download Grav [via this download page](http://getgrav.org/downloads) without the Admin plugin.
2. Extract the zip file to a local folder (say `~/www/brick.camp/`)
3. Switch to the `user`-subfolder (`~/www/brick.camp/user/`) and delete everything inside of it - including hidden files.
4. Now, you can clone this repository into the user folder via:
`git clone https://codeberg.org/swiso-en/website.git .`
5. Switch back to the parent directory (`~/www/brick.camp/`) and run the following command:
`bin/grav install`
This will fetch the additional plugins and theme, that are needed for this Grav website to work properly.
6. Startup the included webserver by routing local requests to `router.php`. Here's how to do it:
`php -S 127.0.0.1:8080 system/router.php`
7. You should be able to access your local website in your browser via `http://127.0.0.1:8080` now.