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


    public function getKeibiVolumeAndIndex() {
        return isset($this->fields['keibi_volume_and_index']) ?
                     $this->fields['keibi_volume_and_index'] : [];
    }
}

