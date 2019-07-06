<?php
require_once '../../classes/NeuralNetwork.class.php';
require_once '../../classes/StatusDataset.class.php';
require_once '../../classes/MysqliDb.class.php';
require_once '../../config/statusconfig.php';
echo "Welcome to trainstatus prediction <br>";


$statusnn = new NeuralNetwork(LAYERS);
$statusnn->setVerbose(false);
$statusnn->addTestData(array (-1, -1, 1), array (-1));
$statusnn->addTestData(array (-1,  1, 1), array ( 1));
$statusnn->addTestData(array ( 1, -1, 1), array ( 1));
$statusnn->addTestData(array ( 1,  1, 1), array (-1));


$max = 3;
$i = 0;

$lr = $learningRates[array_rand($learningRates)];
$m = $momentum[array_rand($momentum)];
$r = $rounds[array_rand($rounds)];
$e = $errors[array_rand($errors)];
echo "<h2>Learning rate $lr, momentum $m @ ($r rounds, max sq. error $e)</h2>";
$statusnn->clear();
$statusnn->setLearningRate($lr);
$statusnn->setMomentum($m);
$i = 0;
while (!($success = $statusnn->train($r, $e)) && ++$i<$max) {
    echo "Round $i: No success...<br />";
    flush();
}

// print a message if the network was succesfully trained
if ($success) {
    $epochs = $statusnn->getEpoch();
    echo "Success in $epochs training rounds!<br />";

    echo "<div class='result'>";
    for ($i = 0; $i < count($statusnn->trainInputs); $i ++) {
        $output = $statusnn->calculate($statusnn->trainInputs[$i]);
        echo "<div>Testset $i; ";
        echo "expected output = (".implode(", ", $statusnn->trainOutput[$i]).") ";
        echo "output from neural network = (".implode(", ", $output).")\n</div>";
    }
    echo "</div>";
}

var_dump($statusnn->export());