<?php
/**
 * @codingStandardsIgnoreFile
 */

$conf['title'] = 'E-Kolgaon APIs';
$conf['version'] = '';
$conf['base_url'] = 'http://kolgaongrampanchayat.org';

// These are the color classes used for API type badge.
// Refer https://getbootstrap.com/docs/5.0/components/badge/ to change classes.
// You can remove this if you want & bg-secondary will be used by default.
$conf['color_codes'] = [
  'GET' => 'bg-primary',
  'POST' => 'bg-success',
  'PUT' => 'bg-warning',
  'PATCH' => 'bg-warning',
  'DELETE' => 'bg-danger',
];
