<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Member;
use App\Models\User;

use Illuminate\Validation\ValidationException;


class MemberImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $this->validate($row);

            // dd($row["mot_de_passe"]);
            $user = new User([
                'firstName' => $row["prenom"],
                'lastName' => $row["nom"],
                'email' => $row["email"],
                'password' => bcrypt($row["mot_de_passe"]),
            ]);


            // dd($user);
            // Save the user
            $user->save();

            // Assign the role
            $user->assignRole('member');

            // Return the created user
            return $user;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessage = implode(', ', $errors);

            return redirect()->route('member.index')->withError('Quelque chose s\'est mal passé, vérifiez votre formulaire: ' . $errorMessage);
        } catch (\Exception $e) {
            return redirect()->route('member.index')->withError('Quelque chose s\'est mal passé, vérifiez votre fichier');
        }

        // } catch (\ErrorException $e) {
        //     return redirect()->route('member.index')->withError('Quelque chose s\'est mal passé, vérifiez votre fichier');
        // }
    }




    /**
     * Validate the row data.
     *
     * @param array $row
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validate(array $row)
    {
        $validator = Validator::make($row, [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'mot_de_passe' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            $redirectResponse = redirect()->route('member.index')->withError('Quelque chose s\'est mal passé, vérifiez votre formulaire: ' . $errorMessage);
            // throw new \Illuminate\Validation\ValidationException($validator);
        }
    }
}
