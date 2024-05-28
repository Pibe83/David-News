<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use App\Mail\SendWelcomeEmail;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class SendWelcomeEmailAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  ActionFields $fields
     * @param  Collection   $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $subject = $fields->email_subjects;

        foreach ($models as $user) {
            Mail::to($user->email)->send(new SendWelcomeEmail($user, $subject));
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Email Subject', 'email_subjects')
                ->rules('max:255'),
        ];
    }
}
