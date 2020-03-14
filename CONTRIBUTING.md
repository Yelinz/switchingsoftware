# Contributing Guidelines

A warm welcome to everyone thinking about supporting this project. Please read this document in full before contributing. If afterwards, you have any questions whatsoever, please feel free to contact us on [the Fediverse][fediverse] via our handle [@switchingsoftware@mstdn.swiso.org][swiso-masto].

## Rules

- Be nice and respectful.
- English only.
- Be constructive.
- See also our [Code of Conduct](https://codeberg.org/swiso-en/website/src/branch/primary/CODE_OF_CONDUCT.md)

## Criteria for Software

Before suggesting a new entry, please use the [issue search][issues] first as it might have been suggested already. Otherwise check for these criteria:

- **Easy to use**: It must be usable by inexperienced persons.
- **Privacy respecting**: It should collect as few information as possible.
- **Trust-worthy**: Promises should aline with actions taken.
- **Open**:  Open Source / Free software is preferred.
- **Accessible**: Accessibility, cross-platform availability and prices / fees should be reasonable.
- **Avoid Vendor Lock-in**: Decentralized / self-hostable software is preferred.
- **Quality over Quantity**: Lists should stay small and simple.
- **Encryption (if applicable)**: Only verifiable encryption is to be trusted. Downloads should be transport-encrypted.

For hosted proprietary services, additionally:
- **Transport Security:** Connections from/to the server must be encrypted (HTTPS, ...).
- **Location**: We prioritize products by privacy respecting nationality.

## Entry format
- **Icon**:
    - At best an web-optimized squarish SVG graphic
    - Otherwise a PNG of size 64px x 64px
    - Either way as lightweight as possible
- **Title**: Official unshortened name of the software or service
- **Description**: (PROPOSAL)
    - First sentence giving a wikipedia-like general explanation of what the software is / does. Should be able to stand on its own.
    - First paragraph explaning details on this first sentence.
    - At most three paragraphs with other interesting details.
    - If there's more to say, it should be in a separate article and/or hyperlinked.
- **Links**: Similar to current entries, especially in the same list.

## Criteria for Website

Before suggesting a feature for the website itself, please think about whether it fits these criteria:

- **All self-hosted**: We won't include any external ressources (like CDNs, trackers).
- **Accessibility**: We want everyone to have equal access to the content of our website.
- **Small footprint**: We want this website to load fast.
- **No JavaScript**: This site must be usable with a script-blocker turned on.

## Licensing

Everything you contribute will be published unter CC-BY-SA 4.0. Differently licensed content must be marked as such and might be removed.

## Workflow

With all this being said, here is a quick overview on how to contribute text/coding to this project

- **Fork:** Login with your codeberg account and [fork this project][fork].
- **Branch:** Create a branch for the topic you want to takle. Give it a meaningful name, p.e. "yourname/fix-issue-1234".
_Hint: Creating a new branch via web interface can be done by typing its name into the branch dropdown on the main page_
- **Edit:** Make changes to your branch. You can do this directly in the browser. For larger changes, you should pull the project onto your computer and edit it in an IDE.
- **Propose:** Create a pull request against the "develop" branch of this repository.

After this, every [maintainer](https://codeberg.org/org/swiso-en/teams/maintainers) is invited to review your proposal. As this project is quite small, this might take a while.

As soon as it gets merged into "develop" branch, the changes can be previewed at https://develop.switching.software. Once a few changes have been collected, they get merged into "primary" and thereby auto-deployed to the main website.

[fediverse]: https://switching.software/articles/federated-sites/
[swiso-masto]: https://mstdn.swiso.org/@switchingsoftware
[issues]: https://codeberg.org/swiso-en/website/issues
[fork]: https://codeberg.org/repo/fork/1574
[maintainer]: https://codeberg.org/org/swiso-en/teams/maintainers
