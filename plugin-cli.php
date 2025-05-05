<?php
/**
 * Plugin Name: ACF × Polylang CLI
 * Description: wp acf-polylang set --mode=copy_once --type=image
 */

if ( defined( 'WP_CLI' ) && WP_CLI ) {

    class ACF_Polylang_CLI {

        /**
         * Bulk‑changes Translation‑mode all ACF fields.
         *
         * ## OPTIONS
         *
         * [--mode=<mode>]
         * : ignore | copy_once | translate | synchronize | translate_once
         *
         * [--type=<type>]
         * : image | text | * (by default *)
         *
         * ## EXAMPLES
         *
         *     wp acf-polylang set --mode=ignore --type=image
         */
        public function set( $args, $assoc ) {

            $mode       = $assoc['mode'] ?? 'ignore';
            $targetType = $assoc['type'] ?? '*';

            $valid = [ 'ignore', 'copy_once', 'translate', 'synchronize', 'translate_once' ];
            if ( ! in_array( $mode, $valid, true ) ) {
                WP_CLI::error( 'Unknown mode.' );
            }

            $groups = acf_get_field_groups();
            foreach ( $groups as $group ) {
                $fields = acf_get_fields( $group['key'] );
                foreach ( $fields as $field ) {
                    $this->recurse_update( $field, $mode, $targetType );
                }
            }
            WP_CLI::success( 'All done!' );
        }

        private function recurse_update( array $field, string $mode, string $targetType ) {

            if ( $targetType === '*' || $field['type'] === $targetType ) {
                $field['translations'] = $mode;
                acf_update_field( $field );
                WP_CLI::log( "✔ {$field['key']} ({$field['label']}) ⇒ {$mode}" );
            }

            if ( ! empty( $field['sub_fields'] ) ) {
                foreach ( $field['sub_fields'] as &$sub ) {
                    $this->recurse_update( $sub, $mode, $targetType );
                }
            }
        }
    }

    WP_CLI::add_command( 'acf-polylang', 'ACF_Polylang_CLI' );
}
