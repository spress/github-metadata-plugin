<?php

use Symfony\Component\EventDispatcher\Event;
use Yosymfony\Spress\Plugin\EventSubscriber;
use Yosymfony\Spress\Plugin\Event\EnvironmentEvent;
use Yosymfony\Spress\Plugin\Plugin;

class SpressGithubMetadataPlugin extends Plugin
{
    private $io;

    public function initialize(EventSubscriber $subscriber)
    {
        $subscriber->addEventListener('spress.start', 'onStart');
    }

    public function onStart(EnvironmentEvent $event)
    {
        $io = $event->getIO();
        $config = $event->getConfigRepository();

        $io->write('Getting Github metadata...');

        $repository = $this->getRepositoryComponents($config['repository']);

        if (2 != count($repository)) {
            $io->write('<error>Invalid repository name.</error>');

            return;
        }

        $client = new \Github\Client();

        $metadataRepo = $client->api('repo')->show($repository['vendor'], $repository['name']);

        $metadata = [
            'name' => $metadataRepo['name'],
            'full_name' => $metadataRepo['full_name'],
            'description' => $metadataRepo['description'],
            'fork' => $metadataRepo['fork'],
            'html_url' => $metadataRepo['html_url'],
            'clone_url' => $metadataRepo['clone_url'],
            'git_url' => $metadataRepo['git_url'],
            'ssh_url' => $metadataRepo['ssh_url'],
            'mirror_url' => $metadataRepo['mirror_url'],
            'homepage' => $metadataRepo['homepage'],
            'forks_count' => $metadataRepo['forks_count'],
            'stargazers_count' => $metadataRepo['stargazers_count'],
            'watchers_count' => $metadataRepo['watchers_count'],
            'size' => $metadataRepo['size'],
            'default_branch' => $metadataRepo['default_branch'],
            'open_issues_count' => $metadataRepo['open_issues_count'],
            'has_issues' => $metadataRepo['has_issues'],
            'has_wiki' => $metadataRepo['has_wiki'],
            'has_pages' => $metadataRepo['has_pages'],
            'has_downloads' => $metadataRepo['has_downloads'],
            'pushed_at' => $metadataRepo['pushed_at'],
            'created_at' => $metadataRepo['created_at'],
            'updated_at' => $metadataRepo['updated_at'],
            'owner' => [
                'login' => $metadataRepo['owner']['login'],
                'avatar_url' => $metadataRepo['owner']['avatar_url'],
                'gravatar_id' => $metadataRepo['owner']['gravatar_id'],
                'html_url' => $metadataRepo['owner']['html_url'],
            ],
            'organization' => [],
            'source' => [],
            'contributors' => [],
        ];

        if (isset($metadataRepo['organization'])) {
            $metadata['organization'] = [
                'login' => $metadataRepo['organization']['login'],
                'avatar_url' => $metadataRepo['organization']['avatar_url'],
                'html_url' => $metadataRepo['organization']['html_url'],
            ];
        }

        if (isset($metadataRepo['source'])) {
            $metadata['source'] = [
                'name' => $metadataRepo['source']['name'],
                'full_name' => $metadataRepo['source']['full_name'],
                'description' => $metadataRepo['source']['description'],
                'html_url' => $metadataRepo['source']['html_url'],
                'clone_url' => $metadataRepo['source']['clone_url'],
                'git_url' => $metadataRepo['source']['git_url'],
                'ssh_url' => $metadataRepo['source']['ssh_url'],
                'svn_url' => $metadataRepo['source']['svn_url'],
                'mirror_url' => $metadataRepo['source']['mirror_url'],
                'homepage' => $metadataRepo['source']['homepage'],
                'forks_count' => $metadataRepo['source']['forks_count'],
                'stargazers_count' => $metadataRepo['source']['stargazers_count'],
                'watchers_count' => $metadataRepo['source']['watchers_count'],
                'size' => $metadataRepo['source']['size'],
                'default_branch' => $metadataRepo['source']['default_branch'],
                'open_issues_count' => $metadataRepo['source']['open_issues_count'],
                'has_issues' => $metadataRepo['source']['has_issues'],
                'has_wiki' => $metadataRepo['source']['has_wiki'],
                'has_pages' => $metadataRepo['source']['has_pages'],
                'has_downloads' => $metadataRepo['source']['has_downloads'],
                'pushed_at' => $metadataRepo['source']['pushed_at'],
                'created_at' => $metadataRepo['source']['created_at'],
                'updated_at' => $metadataRepo['source']['updated_at'],
            ];
        }

        $contributors = $client->api('repo')->contributors($repository['vendor'], $repository['name']);

        foreach ($contributors as $contributor) {
            $metadata['contributors'][] = [
                'login' => $contributor['login'],
                'avatar_url' => $contributor['avatar_url'],
                'html_url' => $contributor['html_url'],
                'type' => $contributor['type'],
                'contributions' => $contributor['contributions'],
            ];
        }

        $config['github'] = $metadata;
    }

    private function getRepositoryComponents($name)
    {
        $result = [];

        if (preg_match('/^([a-z0-9_.-]+)\/([a-z0-9_.-]+)$/i', $name, $matches) && 3 == count($matches)) {
            $result['vendor'] = $matches[1];
            $result['name'] = $matches[2];
        }

        return $result;
    }
}
