<?php

namespace KeiBi\RecordDriver;

class SolrMarc extends SolrDefault
{

    protected function getKeibiReviews() {
        if (isset($this->fields['keibi_reviews'])) {
            return $this->fields['keibi_reviews'];
        }
    }


    public function showKeibiContainerTitles()
    {
        return (!empty($this->getKeibiContainerTitles())
                || $this->getIssue() || $this->getPages()
                || $this->getVolume() || $this->getYear());
    }
}

