<!DOCTYPE html>
<html>
    <head>
        <title>User Excel</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>
                        id</th>
                    <th>
                        name</th>
                    <th>
                        email</th>
                    <th>
                        password</th>
                    <th>
                        isAdmin</th>
                    <th>
                        address</th>
                    <th>
                        postal_code</th>
                    <th>
                        city</th>
                    <th>
                        country</th>
                    <th>
                        deleted_at</th>
                    <th>
                        created_at</th>
                    <th>
                        updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{$user->id}}</td>
                        <td>
                            {{$user->name}}</td>
                        <td>
                            {{$user->email}}</td>
                        <td>
                            {{$user->password}}</td>
                        <td>
                            {{$user->isAdmin}}</td>
                        <td>
                            {{$user->address}}</td>
                        <td>
                            {{$user->postal_code}}</td>
                        <td>
                            {{$user->city}}</td>
                        <td>
                            {{$user->country}}</td>
                        <td>
                            {{$user->deleted_at}}</td>
                        <td>
                            {{$user->created_at}}</td>
                        <td>
                            {{$user->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>