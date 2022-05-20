<?php declare(strict_types = 1);


namespace Pd\Storage\Infrastructure\Delivery\RestAPI\Resources\Files;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetFilesHandler implements RequestHandlerInterface
{

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		return new JsonResponse(
			[
				"files" => [
					[
						"name" => "Mercedes-Benz E class",
						"path" => "media-library/43242/silver-car.png",
						"url" => "https://d62-a.sdn.cz/d_62/c_img_F_H/iKJHG/Mercedes-Benz-e-klasse-facelift.jpeg?fl=cro,62,175,1526,859%7Cres,1200,,1%7Cwebp,75",
						"size" => 474
					],
					[
						"name" => "Mercedes-Benz GLB",
						"path" => "media-library/43242/mercedes-benz-glb.png",
						"url" => "https://www.mercedes-benz.cz/passengercars/mercedes-benz-cars/models/glb/glb-suv/safety/safety-highlights/_jcr_content/par/hotspotsimple/image.MQ6.12.20210330130447.jpeg",
						"size" => 143
					],
					[
						"name" => "Mercedes-Benz AMG GT",
						"path" => "media-library/43242/mercedes-benz-amg-gt.png",
						"url" => "https://www.mercedes-benz.cz/passengercars/mercedes-benz-cars/models/amg-gt/coupe-c190/explore/highlights/_jcr_content/contentgallerycontainer/par/contentgallery/par/contentgallerytile/image.MQ6.8.20210120100447.jpeg",
						"size" => 142
					],
				],
				"totalCount" => 3
			]
		);
	}
}
