<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="This is just a simple way to show the output of the exercise scenarios" />
    <meta name="author" content="Leandro Parra" />

    <title>TrackTik Exercise</title>

    <link rel="stylesheet" href="views/bootstrap/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Exercise result</h1>

        <div id="accordion" class="mb-4">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Scenario
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <p>A person bought:</p>

                        <ul>
                            <li>1 Console</li>
                            <ul>
                                <li>Extras:</li>
                                <li>2 remote controllers</li>
                                <li>2 wired controllers</li>
                            </ul>

                            <li>1 Television</li>
                            <ul>
                                <li>Extras:</li>
                                <li>2 remote controllers</li>
                            </ul>

                            <li>1 Television</li>
                            <ul>
                                <li>Extras:</li>
                                <li>1 remote controller</li>
                            </ul>

                            <li>1 Microwave</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Question #1
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <?php
                        $arrItems = $OrderItems->toArray();
                        ?>

                        <pre><?= json_encode($arrItems, JSON_PRETTY_PRINT) ?></pre>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                            Question #2
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <?php
                        foreach ($ConsoleItems as $console) : ?>
                            <pre><?= json_encode($console->toArray(), JSON_PRETTY_PRINT) ?></pre>
                        <?php endforeach; ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="views/jquery/jquery-slim.js"></script>
    <script src="views/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>