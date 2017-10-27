<?php
	require_once __DIR__ . '/ExtSrc/Services_Openstreetmap-master/Services/OpenStreetMap.php';

	
			$osm = new Services_OpenStreetMap();
			$oh = new Services_OpenStreetMap_OpeningHours(null);
			$node = $osm->getNode(966238869);
			$getTags = $node->getTags();

			$oh->setValue($getTags["opening_hours"]);
			$isopen = $oh->isOpen(time());
			$closedtime = $oh->getClosed();
			echo $isopen . "\n";
			if($isopen)
				$inhalt = '<tr><td style="color: green;" colspan="2">&bull; geöffnet <span style="font-size: 15px;">' . $oh->getOpenedStringFormated() . '</span></td></tr>';
			else
			{
				if($closedtime[0] >= 0)
					$inhalt = '<tr><td style="color: red;" colspan="2">&bull; geschlossen <span style="font-size: 15px;">' . $oh->getClosedStringFormated() . '</span></td></tr>';
				$inhalt = '<tr><td style="color: red;" colspan="2">&bull; geschlossen</td></tr>';
			}

			echo $inhalt . "\n";

			$handle = fopen ("Opened.html", "w");
			fwrite ($handle, $inhalt);
			fclose ($handle);
 ?>