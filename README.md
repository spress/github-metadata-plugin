## Github metadata of a repository

Access to `site.github` for getting a repository's metadata.

**Require**:

* Spress >= 1.0.2
* PHP cURL extension.

### How to install?

Go to your Spress site and add the following to your `composer.json` and run 
`composer update`:

```
"require": {
    "spress/github-metadata-plugin": "~1.0-dev"
}
```

### How to use?

Add the following to your `config.yml`:

```
#Your repository's name:
repository: spress/Spress

```

#### Access to repository's metadada

* **Stargazers count**: `site.github.stargazers_count`.
* **Watchers count**: `site.gihub.watchers_count`.
* **Forks count**: `site.github.forks_count`.
