<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ejemplo de datos para insertar
        $productos = [
            [
                'foto' => 'https://imgs.search.brave.com/Qxl9zu8w3F4wCPBcUqBfejogGztnW5LnXlE_7KbF57c/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9tN2M3/YjVzOS5yb2NrZXRj/ZG4ubWUvd3AtY29u/dGVudC91cGxvYWRz/LzIwMjAvMDQvQ2Vy/dmV6YS1YWC1MYWdl/ci1WaWRyaW8tMzU1/LW1sLi0xLmpwZy53/ZWJw',
                'nombre' => 'XX Laguer Chica',
                'precio' => 40,
                'descripcion' => 'Descripción del Producto 1',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/GEfeFlXAx3Em-0WYnvRWDahBmIFdMUEd9ojNUVUVmOg/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMucmFwcGkuY29t/Lm14L3Byb2R1Y3Rz/LzE2NTI3NjYyNTcw/MThfMTY1Mjc2NjI2/MTkxNi5qcGVnP2U9/d2VicCZkPTkwMHg3/NTAmcT0zMA',
                'nombre' => 'XX Laguer Grande',
                'precio' => 80,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/5b9Bo9eEDo8qVANpw7JHlZOP3W6YTN8GZDhQdPQ6laA/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9iaXJy/YXBlZGlhLmNvbS9p/bWcvbW9kdWxvcy9j/ZXJ2ZXphLzBhMy9k/b3MtZXF1aXMtLXh4/LS1hbWJhcl8xMzg2/MzgxNTEzMzk3OV90/LmpwZw',
                'nombre' => 'XX Ambar Chica',
                'precio' => 40,
                'descripcion' => 'Descripción del Producto 1',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/HeY_NOufUatEiGEgV8nTjA4ByFtcfedlchwINc4aEIE/rs:fit:500:0:0/g:ce/aHR0cDovL3Jlcy5j/bG91ZGluYXJ5LmNv/bS9yYXRlYmVlci9p/bWFnZS91cGxvYWQv/d18xMjAsY19saW1p/dC9iZWVyXzIyNC5q/cGc',
                'nombre' => 'XX Ambar Grande',
                'precio' => 80,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/ZOKRsZlmW9uTYrdpayQO62cFzexevTk-Bl5EdsXpO9o/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9oNy5h/bGFteS5jb20vY29t/cC9ENzcxOUUvYS1w/YWNrLW9mLW1hcmxi/b3JvLXJlZC1jaWdh/cmV0dGVzLUQ3NzE5/RS5qcGc',
                'nombre' => 'Marlboro',
                'precio' => 7,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/8foOwrgIA3LjCMki1cJoBFcKfdH_GrUNQTTcr_cLvhw/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9oYW1i/dXJiaWZlcmlhLmNv/bS93cC1jb250ZW50/L3VwbG9hZHMvMjAy/MC8xMi9QQVBBU0FM/QUZSQU5DRVNBXzEw/MDBYMTAwMC5qcGc',
                'nombre' => 'Papas a la francesa',
                'precio' => 50,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/-U7sYl1ntl3QPjWo8ZEZf0nOnTvmGyVRJ4C_-ywxM4c/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9odHRw/Mi5tbHN0YXRpYy5j/b20vRF9OUV9OUF85/NTQ2ODctTUxVNTQ5/NjUxMDIyMTVfMDQy/MDIzLU8ud2VicA',
                'nombre' => 'Heineken sin alcohol',
                'precio' => 35,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/OJqgxPeuWj-riMK8ok5Nvf8JIrsfT1pGy2G8w4OSFXU/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9odHRw/Mi5tbHN0YXRpYy5j/b20vRF9OUV9OUF85/OTU0NTQtTUxNNDk5/MDI4MTkyMjVfMDUy/MDIyLVcud2VicA',
                'nombre' => 'Squirt',
                'precio' => 30,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/kZOK2Tvzkwu_HJ71DyEI5qBUQrN7s8iEh5rEbQXPKLo/rs:fit:500:0:0/g:ce/aHR0cHM6Ly93d3cu/bWV4Z3JvY2VyLmNv/LnVrL2ltYWdlcy9w/cm9kdWN0L2wvTWFy/dWNoYW4lMjBTaHJp/bXAlMjB3aXRoJTIw/SGFiYW5lcm8uSlBH/P3Q9MTY2NDU3NzMz/NQ',
                'nombre' => 'Maruchan',
                'precio' => 30,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/2BstqFXH4kEPslfEjVnm0yn_PR2hmUCY9KYJbY63Bmg/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9zN2Qy/LnNjZW5lNy5jb20v/aXMvaW1hZ2UvVG90/dHVzUEUvNDIxOTgw/NzNfMT93aWQ9ODAw/JmhlaT04MDAmcWx0/PTcw.jpeg',
                'nombre' => 'Palomitas',
                'precio' => 30,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/A1ZuBT-VDgoPfYFwgrYUUr6_e-i6m2RclLgDGxT2krU/rs:fit:500:0:0/g:ce/aHR0cHM6Ly93d3cu/dGFzdGVib3V0aXF1/ZS5jb20vY2RuL3No/b3AvcHJvZHVjdHMv/QWd1YV9taW5lcmFs/X3BlbmFmaWVsXzYw/MF9tbF81MzB4QDJ4/LmpwZz92PTE2MDQ5/MjM1Mjk',
                'nombre' => 'Peñafiel',
                'precio' => 30,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/sTbFTWbL8oyE_kr836bBVLRAw-36B267TQ9Fph4Dz9g/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMucmFwcGkuY29t/Lm14L3Byb2R1Y3Rz/L2RmYTJhODRhLTZi/ZTQtNDhjZi04MjEw/LTMzODRiY2JjZWFk/Ny5qcGc_ZD0zMDB4/MzAwJmU9d2VicCZx/PTEw',
                'nombre' => 'Caribe Durazno',
                'precio' => 40,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/IQE0-VVI7rEvVLkn-PFZQ25fKMq3aJAxvXlNvfobbf4/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly92aW5v/c2FtZXJpY2EuY29t/L2Nkbi9zaG9wL3By/b2R1Y3RzLzM3NDRf/YjEyZTE3YmUtYzEx/NC00NTY3LWE4YTQt/ZGVhMGViNmNkMjA4/XzgwMHgucG5nP3Y9/MTY4NTMwNzc1OA',
                'nombre' => 'Bohemia 355ml',
                'precio' => 35,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS12mwcsy7AvoypJFalUtAUiqI3vvV_211bbw&s',
                'nombre' => 'Tecate roja 355ml',
                'precio' => 30,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs_WSa4Ugg4-WA9hq-tNiS74GmvSbQb2vFQA&s',
                'nombre' => 'Tecate light 355ml',
                'precio' => 30,
                'descripcion' => 'Descripción del Producto 2',
            ],
            [
                'foto' => 'https://imgs.search.brave.com/0so_azLzTpyGpqVJE2_GCvYXJnqYZYurKZTnsJznjr8/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9sYWN1/YmllbGxhLmNvbS9j/ZG4vc2hvcC9maWxl/cy83NTAxOTQ5NV9j/MDE0NTdmMC05NTU2/LTQ3NDYtYmNiYS02/YTViY2EyMTQyZmQu/d2VicD92PTE2ODM3/NDgwOTgmd2lkdGg9/NjAw',
                'nombre' => 'Indio 355ml',
                'precio' => 30,
                'descripcion' => 'Descripción del Producto 2',
            ],
        ];

        // Insertar los datos en la tabla
        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
