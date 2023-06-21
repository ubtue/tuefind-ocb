<?php

namespace KeiBi\RecordDriver;


class SolrMarc extends SolrDefault
{

    protected function getKeibiReviews() {
        return isset($this->fields['keibi_reviews']) ? $this->fields['keibi_reviews'] : [];
    }


    public function showKeibiContainerTitles()
    {
        if (in_array("Book", $this->getFormats()))
            return false;

        return (!empty($this->getKeibiContainerTitles())
                || $this->getIssue() || $this->getPages()
                || $this->getVolume() || $this->getYear());
    }


    public function getPlacesOfPublication() {
        $_773_fields = $this->getMarcReader()->getFields('773');
        foreach ($_773_fields as $_773_field) {
            $subfield_d = $this->getMarcReader()->getSubfields($_773_field,'d');
             if (!empty($subfield_d))
                return $subfield_d;
        }
    }


    public function showKeibiPublicationDetails() {
        if (!in_array("Book",  $this->getFormats()))
            return false;

        //From original VuFind
        $places = $this->getPlacesOfPublication();
        $names = $this->getPublishers();
        $dates = $this->getPublicationDates();

        $i = 0;
        $retval = [];
        while (isset($places[$i]) || isset($names[$i]) || isset($dates[$i])) {
            // Build objects to represent each set of data; these will
            // transform seamlessly into strings in the view layer.
            $retval[] = new \VuFind\RecordDriver\Response\PublicationDetails(
                $places[$i] ?? '',
                $names[$i] ?? '',
                $dates[$i] ?? ''
            );
            $i++;
        }

        return $retval;
    }


    public function getKeibiVolumeAndIndex() {
        return isset($this->fields['keibi_volume_and_index']) ?
                     $this->fields['keibi_volume_and_index'] : [];
    }
}

