<?php

namespace App\Imports;

use App\Models\Product;

use App\Models\ProductAdditionalField;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;


class ProductImport implements ToCollection
{
    public function collection(Collection $rows): void
    {
        $header = $rows->shift();

        foreach ($rows as $row) {
            $externalCode = $row[5] ?? null;
            $name = $row[4] ?? null;
            $description = $row[10] ?? null;
            $price = $row[8] ?? null;
            $discount = $row[19] ?? null;

            if (!$externalCode || !$name || !$price || !$discount) {
                continue;
            }

            $price = $this->parsePrice($price);
            $discount = $this->parsePrice($discount);

            $product = Product::updateOrCreate(
                ['external_code' => $externalCode],
                [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'discount' => $discount,
                ]
            );

            foreach ($header as $i => $headerName) {
                if (str_starts_with($headerName, 'Доп. поле:')) {
                    $key = trim(str_replace('Доп. поле:', '', $headerName));
                    $value = trim($row[$i]);

                    if ($key && $value) {
                        ProductAdditionalField::updateOrCreate(
                            [
                                'product_id' => $product->id,
                                'key' => $key,
                            ],
                            [
                                'value' => $value,
                            ]
                        );
                    }
                }
            }

            $imageColumns = [36, 37];
            foreach ($imageColumns as $column) {
                if (!empty($row[$column])) {
                    $urls = explode(',', $row[$column]);
                    foreach ($urls as $url) {
                        $url = trim($url);
                        $imagePath = $this->downloadImage($url);
                        if ($imagePath) {
                            ProductImage::updateOrCreate(
                                [
                                    'product_id' => $product->id,
                                    'url' => $url,
                                ],
                                [
                                    'path' => $imagePath,
                                ]
                            );
                        }
                    }
                }
            }
        }
    }

    private function parsePrice($price): float
    {
        $price = str_replace(',', '.', str_replace(' ', '', $price));
        return floatval($price);
    }

    private function downloadImage($url): string
    {
        try {
            $contents = file_get_contents($url);

            $name = basename($url);

            $path = 'public/images/'.$name;

            Storage::put($path, $contents);

            if (Storage::exists($path)) {
                Log::info("Image successfully saved: $path");
                return 'images/'.$name;
            } else {
                throw new Exception("Image not saved: $path");
            }
        } catch (Exception $e) {
            Log::error("Error downloading image from $url: ".$e->getMessage());
            return '';
        }
    }
}
