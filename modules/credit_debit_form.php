<?php

/**
 * @file
 * Credit Debit Form API.
 */

/**
 * Returns endpoint details.
 */
function credit_debit_form_endpoint() {
  return [
    'name' => 'Credit Debit Form API',
    'type' => 'GET',
    'endpoint' => '/api/credit_debit_form/{nid}',
    'description' => 'API to retrieve all Credit and Debit forms in app with <b>basic_auth, cookie</b>.',
    'group' => 'credit_debit_form',
  ];
}

/**
 * Returns expected request parameters.
 */
function credit_debit_form_request() {
  return [
    'nid' => [
      'required' => TRUE,
      'description' => 'String. pass <b>Node ID</b> in endpoint URL, i.e. <b>/api/credit_debit_form/1</b>',
    ],
  ];
}

/**
 * Returns expected response parameters.
 */
function credit_debit_form_response() {
  return [
    200 => [
      [
        'status' => 'true',
        'data' => [
          'field_description' => 'Test credit card',
          'field_transaction_no' => '1',
          'field_total_amount' => '200',
          'field_date' => '2023-05-11',
          'field_select_type' => 'Credit',
          'field_remarks' => 'Paid'
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
