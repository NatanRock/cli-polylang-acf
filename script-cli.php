<?php
// file: set-copy-once.php
$mode       = 'copy_once';        // ignore | copy_once | translate | synchronize
$targetType = 'image';            // image | file | text | textarea | wysiwyg |  ... | * (all fields)

require_once ABSPATH . 'wp-load.php';

function recurse_update( array $field, string $mode, string $targetType ): array {
    // if type matches or update all is needed
    if ( $targetType === '*' || $field['type'] === $targetType ) {
        $field['translations'] = $mode;
        acf_update_field( $field );
        WP_CLI::log( "✔ {$field['key']} ⇒ {$mode}" );
    }

    // process sub-fields (group, repeater, flexible)
    if ( ! empty( $field['sub_fields'] ) ) {
        foreach ( $field['sub_fields'] as &$sub ) {
            $sub = recurse_update( $sub, $mode, $targetType );
        }
    }
    return $field;
}

$groups = acf_get_field_groups();
foreach ( $groups as $group ) {
    $fields = acf_get_fields( $group['key'] );
    foreach ( $fields as $field ) {
        recurse_update( $field, $mode, $targetType );
    }
}
WP_CLI::success( 'Done.' );