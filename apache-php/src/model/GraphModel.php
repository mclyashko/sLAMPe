<?php

namespace model;

require_once '/var/www/vendor/autoload.php';

use Faker;
use GdImage;
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

class fakeCatData
{
    public string $name;
    public string $color;
    public string $longitude;
    public string $latitude;
    public string $job;
    public string $mail;
    public string $description;

    /**
     * @param string $name
     * @param string $color
     * @param string $longitude
     * @param string $latitude
     * @param string $job
     * @param string $mail
     * @param string $description
     */
    public function __construct(
        string $name, string $color, string $longitude,
        string $latitude, string $job, string $mail,
        string $description)
    {
        $this->name = $name;
        $this->color = $color;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->job = $job;
        $this->mail = $mail;
        $this->description = $description;
    }
}

class GraphModel
{
    static private ?GraphModel $state = null;

    private function __construct()
    {
    }

    public static function getState(): ?GraphModel
    {
        if (GraphModel::$state == null) {
            GraphModel::$state = new GraphModel();
        }

        return GraphModel::$state;
    }

    private function generate_cats(int $cats_amount): array
    {
        $faker = Faker\Factory::create();

        $cats = array();

        for ($i = 0; $i < $cats_amount; $i++) {
            $cats[] = new fakeCatData(
                $faker->name(),
                $faker->colorName(),
                $faker->latitude(),
                $faker->longitude(),
                $faker->jobTitle(),
                $faker->email(),
                implode(' ', $faker->randomElements($faker->shuffle(['meow', 'mew', 'mewl', 'miaou', 'miau', 'miauw', 'miao', 'mjay', 'nya', 'nyan']), 7))
            );
        }

        return $cats;
    }

    private function raw_data(): array
    {
        return json_decode(file_get_contents('./view/fakeCats.json'));
    }

    private function draw_pie(): void
    {
        $graph = new Graph\PieGraph(500, 500);
        $graph->title->Set("DESCRIPTION LENGTH");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $graph->SetBox(true);

        $raw_data = $this->raw_data();

        $mapped = array();
        foreach ($raw_data as $d) {
            $mapped[strlen($d->description)] += 1;
        }

        $labels = array_map('strval', array_keys($mapped));
        for($i = 0; $i < count($labels); $i++){
            $labels[$i] = $labels[$i] . 'symbs';
        }
        $values = array_values($mapped);

        $plot = new Plot\PiePlot($values);
        $plot->ShowBorder();
        $plot->SetColor('red');
        $plot->SetLabels($labels);

        $graph->Add($plot);

        $graph->Stroke("./view/pie.png");
    }

    private function draw_bar(): void
    {
        $graph = new Graph\Graph(500, 500, 'auto');
        $graph->title->Set("NYA vs NO NYA");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $graph->SetShadow(true);

        $raw_data = $this->raw_data();

        $mapped = array();
        foreach ($raw_data as $d) {
            $description = $d->description;
            if (str_contains($description, 'nya')) {
                $mapped['nya'] += 1;
            } else {
                $mapped['no nya'] += 1;
            }
        }

        $labels = array_map('strval', array_keys($mapped));
        for($i = 0; $i < count($labels); $i++){
            $labels[$i] = $labels[$i] . ' descs';
        }
        $values = array_values($mapped);

        $graph->SetScale('textlin');
        $graph->xaxis->SetTickLabels($labels);

        $plot = new Plot\BarPlot($values);

        $graph->Add($plot);

        $graph->Stroke('./view/bar.png');
    }

    private function draw_scatter(): void
    {
        $graph = new Graph\Graph(500,500);
        $graph->title->Set("Description length forward to the name length");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $graph->SetShadow(true);

        $raw_data = $this->raw_data();

        $mapped = array();
        foreach ($raw_data as $d) {
            $mapped['description length'][] = strlen($d->description);
            $mapped['name length'][] = strlen($d->name);
        }

        $labels = array_values($mapped['description length']);
        $values = array_values($mapped['name length']);

        $graph->SetScale("linlin");

        $plot = new Plot\ScatterPlot($values, $labels);

        $graph->Add($plot);

        $graph->Stroke('./view/scatter.png');
    }

    private function resize_image($image, $w, $h): GdImage|bool
    {
        $oldw = imagesx($image);
        $oldh = imagesy($image);
        $temp = imagecreatetruecolor($w, $h);
        imagecopyresampled($temp, $image, 0, 0, 0, 0, $w, $h, $oldw, $oldh);
        return $temp;
    }

    private function add_watermark(string $to_add, string $watermark): void
    {
        $stamp = imagecreatefrompng($watermark);
        $im = imagecreatefrompng($to_add);

        $stamp = $this->resize_image($stamp, 128, 87);
        imagealphablending($stamp, false);
        imagesavealpha($stamp, true);
        imagefilter($stamp, IMG_FILTER_COLORIZE, 0,0,0,127*0.5);

        $marge_right = 100;
        $marge_bottom = 100;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

        imagepng($im, $to_add);
        imagedestroy($im);
        imagedestroy($stamp);
    }

    public function printGraphs(): array
    {
        file_put_contents('./view/fakeCats.json',
            json_encode(
                $this->generate_cats(3)
            )
        );

        $this->draw_pie();
        $this->draw_bar();
        $this->draw_scatter();

        $this->add_watermark('./view/pie.png', './view/cat_watermark.png');
        $this->add_watermark('./view/bar.png', './view/cat_watermark.png');
        $this->add_watermark('./view/scatter.png', './view/cat_watermark.png');

        return $this->raw_data();
    }
}