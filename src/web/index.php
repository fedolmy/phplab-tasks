<?php
require_once './functions.php';

$airports = require './airports.php';

define('AIRPORTS_PER_PAGE', 5);

// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 */

if (isset($_GET['filter_by_first_letter'])) {
    $airports = filterByLetter($airports, $_GET['filter_by_first_letter']);
}
if (isset($_GET['filter_by_state'])) {
    $airports = filterByState($airports, $_GET['filter_by_state']);
}

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 */

if (isset($_GET['sort'])) {
    usort($airports, sortByKeyValue($_GET['sort']));
}

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 */

$total = intval(((count($airports) - 1) / AIRPORTS_PER_PAGE) + 1);
$page = $_GET['page'] ?? 1;
if ($page > $total) {
    $page = $_GET['page'] = $total;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters($airports) as $letter): ?>
            <a href="/?<?= http_build_query(array_merge($_GET, ['filter_by_first_letter' => $letter, 'page' => 1])) ?>"><?= $letter ?></a>
        <?php endforeach;?>

        <a href="/" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="/?<?= http_build_query(array_merge($_GET, ['sort' => 'name'])) ?>">Name</a></th>
            <th scope="col"><a href="/?<?= http_build_query(array_merge($_GET, ['sort' => 'code'])) ?>">Code</a></th>
            <th scope="col"><a href="/?<?= http_build_query(array_merge($_GET, ['sort' => 'state'])) ?>">State</a></th>
            <th scope="col"><a href="/?<?= http_build_query(array_merge($_GET, ['sort' => 'city'])) ?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php $start = ($page * AIRPORTS_PER_PAGE) - AIRPORTS_PER_PAGE;?>
        <?php $airports = array_slice($airports, $start, AIRPORTS_PER_PAGE);?>
        <?php foreach ($airports as $airport): ?>
        <tr>
            <td><?= $airport['name'] ?></td>
            <td><?= $airport['code'] ?></td>
            <td><a href="/?<?= http_build_query(array_merge($_GET, ['filter_by_state' => $airport['state'], 'page' => 1])) ?>"><?= $airport['state'] ?></a></td>
            <td><?= $airport['city'] ?></td>
            <td><?= $airport['address'] ?></td>
            <td><?= $airport['timezone'] ?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page > 2): ?>
                <li class='page-item start'><a class='page-link' href="/?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>">1</a></li>
            <?php endif;?>
            <?php if ($page > 3 && $total > 4): ?>
                <li class='page-item prev'><a class='page-link' href="/?<?= http_build_query(array_merge($_GET, ['page' => ($page - 1)])) ?>"><</a>
            <?php endif;?>
            <?php if ($page - 1 > 0): ?>
                <li class='page-item'><a class='page-link' href="/?<?= http_build_query(array_merge($_GET, ['page' => ($page - 1)])) ?>"><?= ($page - 1) ?></a>
            <?php endif;?>
                <li class='page-item active'><a class='page-link' href="/?<?= http_build_query(array_merge($_GET, ['page' => $page])) ?>"><?= ($page) ?></a>
            <?php if ($page + 1 <= $total): ?>
                <li class='page-item'><a class='page-link' href="/?<?= http_build_query(array_merge($_GET, ['page' => ($page + 1)])) ?>"><?= ($page + 1) ?></a>
            <?php endif;?>
            <?php if ($page < $total - 2 && $total > 4): ?>
                <li class='page-item next'><a class='page-link' href="/?<?= http_build_query(array_merge($_GET, ['page' => ($page + 1)])) ?>">></a>
            <?php endif;?>
            <?php if ($page < $total - 1): ?>
                <li class='page-item end'><a class='page-link' href="/?<?= http_build_query(array_merge($_GET, ['page' => $total])) ?>"><?= $total ?></a></li>
            <?php endif;?>
        </ul>
    </nav>

</main>
</html>
