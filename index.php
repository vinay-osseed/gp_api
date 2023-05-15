<?php
/**
 * @codingStandardsIgnoreFile
 */

require_once 'config.php';
require_once 'apis.php';
require_once 'groups.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php echo $conf['title']; ?></title>
    <style>
      body {
        font-family: Ubuntu;
      }
    </style>
  </head>
  <body>
    <header class="navbar navbar-expand-md navbar-dark bg-primary">
      <nav class="container-xxl flex-wrap flex-md-nowrap" aria-label="Main navigation">
        <a class="navbar-brand p-0 me-2" href="/" aria-label="Bootstrap"><h3><?php echo $conf['title']; ?><sup><?php echo $conf['version']; ?></sup></h3></a>
      </nav>
    </header>

    <div class="container my-5">
      <p class="font-monospace">Base URL: <?php echo $conf['base_url']; ?></p>
      <?php $group_apis = []; ?>
      <?php foreach ($apis as $module): ?>
        <?php $file = 'modules/' . $module . '.php'; ?>
        <?php if (!file_exists($file)): ?>
          <?php continue; ?>
        <?php endif; ?>
        <?php require_once 'modules/' . $module . '.php'; ?>
        <?php $endpoint_fn = $module . '_endpoint'; ?>
        <?php $endpoint = $endpoint_fn(); ?>
        <?php $group_name = !empty($endpoint['group']) ? $endpoint['group'] : NULL; ?>
        <?php $group_apis[$group_name][$module] = $endpoint; ?>
      <?php endforeach; ?>
      <?php foreach ($group_apis as $group_name => $modules): ?>
        <p class="fw-bolder"><?php print $groups[$group_name]['name']; ?><span class="small fw-light"> - <?php print $groups[$group_name]['description']; ?></span></p>
        <div class="accordion mb-4" id="apiDoc-<?php print $group_name; ?>">
          <?php foreach ($modules as $endpoint_name => $endpoint): ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="<?php echo $endpoint_name; ?>-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $endpoint_name; ?>-collapse" aria-expanded="true" aria-controls="<?php echo $endpoint_name; ?>-collapse">
                  <?php $endpoint_type = mb_strtoupper($endpoint['type']); ?>
                  <?php $badge_class = !empty($conf['color_codes'][$endpoint_type]) ? $conf['color_codes'][$endpoint_type] : 'bg-secondary'; ?>
                  <p class="lead m-0"><span class="me-2 badge <?php print $badge_class; ?>" style="min-width:65px;"><?php print $endpoint_type; ?></span>&nbsp;<span class="text-dark fs-6"><?php print $endpoint['endpoint'] . ' - ' . $endpoint['name']; ?></span></p>
                </button>
              </h2>
              <div id="<?php echo $endpoint_name; ?>-collapse" class="accordion-collapse collapse" aria-labelledby="<?php echo $endpoint_name; ?>-header" data-bs-parent="#apiDoc-<?php print $group_name; ?>">
                <div class="accordion-body">
                  <div class="description mb-2"><?php print $endpoint['description']; ?></div>
                  <?php $request_fn = $endpoint_name . '_request'; ?>
                  <?php $parameters = $request_fn(); ?>
                  <?php $example_request = []; ?>
                  <div class="table-responsive">
                    <table class="table table-light table-hover caption-top small">
                      <caption>Request Parameters</caption>
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Required</th>
                          <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($parameters)): ?>
                          <?php foreach ($parameters as $param => $param_data): ?>
                            <tr>
                              <td class="font-monospace"><?php print $param; ?></td>
                              <td>
                                <?php if (!empty($param_data['required'])): ?>
                                  <strong>Yes</strong>
                                <?php endif; ?>
                              </td>
                              <td><?php print $param_data['description']; ?></td>
                            </tr>
                            <?php if (isset($param_data['value'])): ?>
                              <?php $example_request[$param] = $param_data['value']; ?>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr><td colspan="3">No parameters are needed.</td></tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <?php if (!empty($example_request)): ?>
                    <div class="table-responsive">
                      <table class="table table-light table-hover caption-top small">
                        <caption>Example Request</caption>
                        <thead>
                          <tr>
                            <th>Request</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <?php $ex_json = json_encode($example_request, JSON_PRETTY_PRINT); ?>
                              <div class="bg-dark text-white p-2 mb-2">
                                <pre class="m-0"><?php print $ex_json; ?>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  <?php endif; ?>

                  <?php $response_fn = $endpoint_name . '_response'; ?>
                  <?php $response = $response_fn(); ?>
                  <div class="table-responsive">
                    <table class="table table-light table-hover caption-top small">
                      <caption>Responses</caption>
                      <thead>
                        <tr>
                          <th>Code</th>
                          <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($response as $code => $response_data): ?>
                          <tr>
                            <td><?php print $code; ?></td>
                            <td>
                              <?php foreach ($response_data as $resp): ?>
                                <?php $json = json_encode($resp, JSON_PRETTY_PRINT); ?>
                                <div class="bg-dark text-white p-2 mb-2">
                                  <pre class="m-0"><?php print $json; ?>
                                </div>
                              <?php endforeach; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <footer class="text-center py-2 mt-2 bg-light">
      <div class="footer-copyright text-center text-black-50 small">
          Made by
          <a class="black-text" target="_blank" href="https://osseed.com/">
             osseed.com
          </a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
