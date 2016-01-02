## Github metadata of a repository

![Spress 2 ready](https://img.shields.io/badge/Spress%202-ready-brightgreen.svg)

Access to `site.github` for getting a repository's metadata.

**Requires**:

* Spress >=2.0
* PHP cURL extension.

If you are using Spress 1.x, go to [1.0.0](https://github.com/spress/Github-metadata-plugin/tree/v1.0.0) version of the plugin.

### How to install?

Go to your Spress site and add the following to your `composer.json` and run 
`composer update`:

```json
"require": {
    "spress/github-metadata-plugin": "2.0.*"
}
```

### How to use?

Add the following to your `config.yml`:

```yaml
#Your repository's name:
repository: "spress/Spress"

```

#### Access to repository's metadada

* **Stargazers count**: `site.github.stargazers_count`.
* **Watchers count**: `site.gihub.watchers_count`.
* **Forks count**: `site.github.forks_count`.

See [Github repos API](https://developer.github.com/v3/repos/).

Another metada:

* name
* full_name
* description
* fork
* html_url
* clone_url
* git_url
* ssh_url
* mirror_url
* homepage
* size
* default_branch
* open_issues_count
* has_issues
* has_pages
* has_downloads
* pushed_at
* created_at
* updated_at

##### Contributors metadata

Access to `site.github.contributors` for getting an arra with contributors metadata.

See [Github repos API](https://developer.github.com/v3/repos/#list-contributors).

* login
* avatar_url
* html_url
* type
* contributions

##### Owner metada

Access to `site.github.owner` for getting owner metadata.

* login
* avatar_url
* gravatar_id
* html_url

##### Organization metadata

Access to `site.github.organization` for getting organization metadata.

* login
* avatar_url
* html_url

##### Source metadata

Access to `site.github.source` for getting source metadata.

* name
* full_name
* description
* html_url
* clone_url
* git_url
* ssh_url
* svn_url
* mirror_url
* homepage
* forks_count
* stargazers_count
* watchers_count
* size
* default_branch
* open_issues_count
* has_issues
* has_wiki
* has_pages
* has_downloads
* pushed_at
* created_at
* updated_at
