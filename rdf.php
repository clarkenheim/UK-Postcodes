<?php
if ($single) {
$row['postcode'] = str_replace(" ", "", $row['postcode']);
?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#" xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#" xmlns:spatialrelations="http://data.ordnancesurvey.co.uk/ontology/spatialrelations/" xmlns:admingeo="http://statistics.data.gov.uk/def/administrative-geography/" xmlns:elecgeo="http://statistics.data.gov.uk/def/electoral-geography/" xmlns:osadmingeo="http://data.ordnancesurvey.co.uk/ontology/admingeo/" xmlns:owl="http://www.w3.org/2002/07/owl#" >
 <rdf:Description rdf:about="http://<?php echo $_SERVER['SERVER_NAME'] ?>/postcode/<?php echo strtoupper($row['postcode']); ?>">
   <rdfs:label><?php echo strtoupper($row['postcode']); ?></rdfs:label>	
   <owl:sameAs rdf:resource="http://data.ordnancesurvey.co.uk/id/postcodeunit/<?php echo strtoupper($row['postcode']); ?>"/>
   <geo:lat rdf:datatype="http://www.w3.org/2001/XMLSchema#decimal"><?php echo $lat; ?></geo:lat>
   <geo:long rdf:datatype="http://www.w3.org/2001/XMLSchema#decimal"><?php echo $lng; ?></geo:long>
   <spatialrelations:easting rdf:datatype="http://www.w3.org/2001/XMLSchema#float"><?php echo $easting; ?></spatialrelations:easting>
   <spatialrelations:northing rdf:datatype="http://www.w3.org/2001/XMLSchema#float"><?php echo $northing; ?></spatialrelations:northing>
<?php if (!strstr($row['countygss'], "99999999")) { ?> 
   <spatialrelations:t_spatiallyInside rdf:resource="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['countysnac']; ?>" />
   <spatialrelations:t_spatiallyInside rdf:resource="<?php echo $edistrict['uri']; ?>" />
<?php } ?>
   <spatialrelations:t_spatiallyInside rdf:resource="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['councilsnac']; ?>" />
   <spatialrelations:t_spatiallyInside rdf:resource="http://statistics.data.gov.uk/id/electoral-ward/<?php echo $row['wardsnac']; ?>" />
   <?php if ($row['county'] != "00") { ?> 
   <admingeo:localAuthority rdf:resource="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['countysnac']; ?>" />
   <osadmingeo:CountyElectoralDivision rdf:resource="<?php echo $edistrict['uri']; ?>" />
<?php } ?>
   <admingeo:localAuthority rdf:resource="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['councilsnac']; ?>" />
   <elecgeo:parliamentaryConstituency rdf:resource="<?php echo $constituencyuri; ?>" />
   <elecgeo:ward rdf:resource="http://statistics.data.gov.uk/id/electoral-ward/<?php echo $row['wardsnac']; ?>" />
   <rdf:type rdf:resource="http://data.ordnancesurvey.co.uk/ontology/postcode/PostcodeUnit"/>
 </rdf:Description>
 <?php if ($row['county'] != "00") { ?> 
 <rdf:Description rdf:about="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['countysnac']; ?>">
   <rdfs:label><?php echo $countytitle; ?></rdfs:label>
 </rdf:Description>
<?php } ?>
 <rdf:Description rdf:about="http://statistics.data.gov.uk/id/local-authority/<?php echo $row['councilsnac']; ?>">
   <rdfs:label><?php echo $districttitle; ?></rdfs:label>
 </rdf:Description>
 <rdf:Description rdf:about="http://statistics.data.gov.uk/id/electoral-ward/<?php echo $row['wardsnac']; ?>">
   <rdfs:label><?php echo $wardtitle; ?></rdfs:label>
 </rdf:Description>
</rdf:RDF>
<?php } elseif ($distance) { ?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#">
<?php
while ($row = mysql_fetch_array($result)) {
$row['postcode'] = str_replace(" ", "", $row['postcode']);
?>
  <rdf:Description rdf:about="http://<?php echo $_SERVER['SERVER_NAME'] ?>/postcode/<?php echo strtoupper($row['postcode']); ?>">
  	  <rdfs:label><?php echo strtoupper($row['postcode']); ?></rdfs:label>
   	  <geo:lat rdf:datatype="http://www.w3.org/2001/XMLSchema#decimal"><?php echo $lat; ?></geo:lat>
      <geo:long rdf:datatype="http://www.w3.org/2001/XMLSchema#decimal"><?php echo $lng; ?></geo:long>	
  </rdf:Description>
<?php } ?>
</rdf:RDF>
<?php } ?>