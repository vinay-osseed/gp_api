<?php

/**
 * @file
 * Add News API.
 */

/**
 * Returns endpoint details.
 */
function news_endpoint() {
  return [
    'name' => 'News API',
    'type' => 'GET',
    'endpoint' => '/api/news',
    'description' => 'API for retrieving latest 5 news contents in app with <b>basic_auth,cookie</b>.',
    'group' => 'news',
  ];
}

/**
 * Returns expected request parameters.
 */
function news_request() {
  return [];
}

/**
 * Returns expected response parameters.
 */
function news_response() {
  return [
    200 => [
      [
        'status' => 'true',
        'data' => [
          [
            'index' => '1',
            'title' => 'News 1',
            'field_type' => 'News',
            'body' => 'content',
            'images' => [
              'url' => 'http://kolgaongrampanchayat.org/sites/default/files/2023-05/dummy_0.pdf',
              'url' => 'http://kolgaongrampanchayat.org/sites/default/files/2023-05/1-house_0.jpg',
            ],
          ],
          [
            'index' => '2',
            'title' => 'News 2',
            'field_type' => 'News',
            'body' => 'content',
            'images' => [
              'url' => 'http://kolgaongrampanchayat.org/sites/default/files/2023-05/dummy_0.pdf',
            ],
          ],
          [
            'index' => '3',
            'title' => 'News 3',
            'field_type' => 'News',
            'body' => 'content',
            'images' => [],
          ],
          [
            'index' => '4',
            'title' => 'News 4',
            'field_type' => 'News',
            'body' => 'content',
            'images' => [
              'url' => 'http://kolgaongrampanchayat.org/sites/default/files/2023-05/1-house_0.jpg',
            ],
          ],
          [
            'index' => '5',
            'title' => 'News 5',
            'field_type' => 'News',
            'body' => 'content',
            'images' => [
              'url' => 'http://kolgaongrampanchayat.org/sites/default/files/2023-05/dummy_0.pdf',
              'url' => 'http://kolgaongrampanchayat.org/sites/default/files/2023-05/1-house_0.jpg',
            ],
          ],
        ],
      ],
    ],
    400 => [
      [
        'status' => 'bool',
        'error' => [
          'message' => 'string',
          'statusCode' => 'int',
        ],
      ],
    ],
  ];
}
