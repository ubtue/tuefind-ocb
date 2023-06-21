<?php

namespace KeiBi\View\Helper\Root;

use Interop\Container\ContainerInterface;
use KeiBi\View\Helper\Root\RecordDataFormatter\SpecBuilder;

class RecordDataFormatterFactory extends \IxTheo\View\Helper\Root\RecordDataFormatterFactory {


    public function __invoke(ContainerInterface $container, $requestedName,
        array $options = null
    ) {
        return parent::__invoke($container, $requestedName, $options);
    }


    protected function addKeibiContainerTitles(&$spec) {
         $spec->setTemplateLine(
            'In', 'showKeibiContainerTitles', 'data-keibi-container-titles.phtml'
        );
    }

    protected function addKeibiPublicationDetails(&$spec) {
         $spec->setTemplateLine(
            'Published', 'showKeibiPublicationDetails', 'data-keibi-publicationDetails.phtml'
        );
    }

    protected function addKeibiVolumeAndIndex(&$spec) {
         $spec->setLine('Keibi Volume And Index', 'getKeibiVolumeAndIndex', null);
    }

    /**
     * Get default specifications for displaying data in core metadata.
     *
     * @return array
     */
    public function getDefaultCoreSpecs()
    {
        $spec = new SpecBuilder();
        $this->addPublishedIn($spec);
        $this->addFollowingTitle($spec); // TueFind specific
        $this->addPrecedingTitle($spec);  // TueFind specific
        // Other Titles (IxTheo-specific)
        $spec->setLine(
            'Other Titles', 'getOtherTitles'
        );
        $this->addDeduplicatedAuthors($spec);
        $this->addFormats($spec);
        //$this->addLanguages($spec);
        //$this->addSubito($spec);
        //$this->addHBZ($spec);
        //$this->addJOP($spec);
        $this->addPublications($spec);
        //$this->addContainerIdsAndTitles($spec);
        $this->addKeibiContainerTitles($spec);
        $this->addKeibiPublicationDetails($spec);
        $this->addKeibiVolumeAndIndex($spec);
        $spec->setTemplateLine('all_reviews', 'getKeibiReviews', 'data-keibiReviews.phtml');

        $this->addVolumesAndArticles($spec);
        $this->addEdition($spec);
        $this->addSeries($spec);
        // Standardized Subjects (IxTheo-specific)
        $spec->setTemplateLine(
            'Standardized Subjects', 'getAllStandardizedSubjectHeadings', 'data-allStandardizedSubjectHeadings.phtml'
        );

        // Non-standardized Subjects (IxTheo-specific)
        $spec->setTemplateLine(
            'Nonstandardized Subjects', 'getAllNonStandardizedSubjectHeadings', 'data-allNonStandardizedSubjectHeadings.phtml'
        );
        $this->addChildRecords($spec);
        $this->addOnlineAccess($spec);
        $this->addLicense($spec); // TueFind specific
        $this->addRecordLinks($spec);
        $this->addTags($spec);

        return $spec->getArray();
    }

    public function getDefaultDescriptionSpecs()
    {
        $spec = new SpecBuilder();
        $spec->setTemplateLine('Summary', true, 'data-summary.phtml');
        $spec->setLine('Published', 'getDateSpan');
        // Item Description (IxTheo-specific)
        $spec->setTemplateLine('Item Description', 'getGeneralNotes', 'data-general-notes.phtml');
        $spec->setLine('Physical Description', 'getPhysicalDescriptions');
        $spec->setLine('Publication Frequency', 'getPublicationFrequency');
        $spec->setLine('Playing Time', 'getPlayingTimes');
        $spec->setLine('Format', 'getSystemDetails');
        $spec->setLine('Audience', 'getTargetAudienceNotes');
        $spec->setLine('Awards', 'getAwards');
        $spec->setLine('Production Credits', 'getProductionCredits');
        $spec->setLine('Bibliography', 'getBibliographyNotes');
        // Clean ISBN with schema.org-property (IxTheo-specific)
        $spec->setLine(
            'ISBN', 'getCleanISBN', null,
            ['prefix' => '<span property="isbn">', 'suffix' => '</span>']
        );
        // ISSN with schema.org-property (IxTheo-specific)
        $spec->setLine(
            'ISSN', 'getISSNs', null,
            ['prefix' => '<span property="issn">', 'suffix' => '</span>']
        );
        $spec->setLine('Related Items', 'getRelationshipNotes');
        $spec->setLine('Access', 'getAccessRestrictions');
        $spec->setLine('Finding Aid', 'getFindingAids');
        $spec->setLine('Publication_Place', 'getHierarchicalPlaceNames');
        $spec->setTemplateLine('Author Notes', true, 'data-authorNotes.phtml');
        return $spec->getArray();
    }
}
