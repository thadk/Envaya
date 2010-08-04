<?php

/**
 * Convert a database row to a new ElggMetadata
 *
 * @param stdClass $row
 * @return stdClass or ElggMetadata
 */
function row_to_elggmetadata($row)
{
    if (!($row instanceof stdClass))
        return $row;

    return new ElggMetadata($row);
}

function get_metadata($id)
{
    return row_to_elggmetadata(
        get_data_row("SELECT * FROM metadata WHERE id = ?", array($id))
    );
}

function get_metadata_byname($entity_guid, $name)
{
    return row_to_elggmetadata(get_data_row(
        "SELECT * from metadata where entity_guid=? and name=? LIMIT 1", array($entity_guid, $name)
    ));
}

function get_metadata_for_entity($entity_guid)
{
    return array_map('row_to_elggmetadata', get_data(
        "SELECT * from metadata where entity_guid=?", array($entity_guid)
    ));
}
