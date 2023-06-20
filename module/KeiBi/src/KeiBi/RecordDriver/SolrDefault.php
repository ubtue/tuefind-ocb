<?php

namespace KeiBi\RecordDriver;

class SolrDefault extends \IxTheo\RecordDriver\SolrMarc {

    public function getKeibiContainerTitles()
    {
        // With KeiBi we currently do not have properly set up superior works so get textual representation
        return $this->getJournalIssue() ? $this->getJournalIssue()  : [];
    }


}
