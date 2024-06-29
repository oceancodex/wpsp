<?php

namespace WPSP\app\Observers;
use WPSP\app\Models\Settings;

class SettingsObserver {

	/**
	 * Handle the WebsiteGroups "creating" event.
	 *
	 * @param Settings $setting
	 *
	 * @return void
	 */
	public function creating(Settings $setting): void {
		//
	}

	/**
	 * Handle the CampaignGroups "created" event.
	 *
	 * @param Settings $setting
	 *
	 * @return void
	 */
	public function created(Settings $setting): void {
		//
	}

	/**
	 * Handle the CampaignGroups "updating" event.
	 *
	 * @param Settings $setting
	 *
	 * @return void
	 */
	public function updating(Settings $setting): void {
		//
//		error_log(print_r($setting, true));
	}

	/**
	 * Handle the CampaignGroups "updated" event.
	 *
	 * @param Settings $setting
	 *
	 * @return void
	 */
	public function updated(Settings $setting): void {
		//
	}

	/**
	 * Handle the CampaignGroups "deleted" event.
	 *
	 * @param Settings $setting
	 *
	 * @return void
	 */
	public function deleted(Settings $setting): void {
		//
	}

	/**
	 * Handle the CampaignGroups "restored" event.
	 *
	 * @param Settings $setting
	 *
	 * @return void
	 */
	public function restored(Settings $setting): void {
		//
	}

	/**
	 * Handle the CampaignGroups "force deleted" event.
	 *
	 * @param Settings $setting
	 *
	 * @return void
	 */
	public function forceDeleted(Settings $setting): void {
		//
	}

}