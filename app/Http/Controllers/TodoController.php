<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class TodoController extends Controller
{
    // Show all tod`os
    public function index()
    {
        $todos = Auth::user()->todos()->latest()->get();
        return view('todos.index', compact('todos'));
    }
    // Store new todo
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:low,medium,high',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
    
        $user = Auth::user();
    
        // Simpan todo baru
        $todo = $user->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);
    
        // Format tanggal jika ada
        $tanggal = $todo->due_date ? \Carbon\Carbon::parse($todo->due_date)->translatedFormat('l, d F Y') : '-';
    
        // Template pesan WhatsApp
        $message = "*Reminder Todo Baru ✔*\n"
            ."Halo, {$user->name}.\n\n"
            ."Todo baru telah dibuat dengan detail berikut:\n"
            ."📌 Judul: {$todo->title}\n"
            ."📝 Deskripsi: {$todo->description}\n"
            ."📅 Tanggal: {$tanggal}\n\n"
            ."Jangan lupa untuk menyelesaikan todo ini tepat waktu!\n\n"
            ."Salam,\n[Tim Reminder Todo]";
    
        // Kirim pesan ke nomor WhatsApp user (pastikan field telepon ada di tabel users)
        $this->sendMessage($user->telepon, $message);
    
        return redirect()->back()->with('success', 'Todo berhasil ditambahkan!');
    }
    // Update todo
    public function update(Request $request, Todo $todo)
    {
        // Simple check - hanya owner yang bisa edit
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'due_date' => 'nullable|date',
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority ?? 'medium',
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->back()->with('success', 'Todo berhasil diupdate!');
    }

    // Delete todo
    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $todo->delete();
        return redirect()->back()->with('success', 'Todo berhasil dihapus!');
    }

    // Toggle complete status (AJAX)
    public function toggle(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $todo->update([
            'status' => $todo->status === 'completed' ? 'pending' : 'completed'
        ]);

        return response()->json(['success' => true, 'status' => $todo->status]);
    }

    public function sendMessage($nomor, $pesan)
    {
        // Kirim pesan ke nomor telepon mengugunakan API Wablas
        $curl = curl_init();
		$token = "39UkEbGICVD68BAzSR8pi6cpQYRdjhydk6n8prXg9a4fWVv5Mjgye9y";
        $secretKey = "cojhYlSM";
        $accessKey = $token.'.'.$secretKey;
		$data = [
			'phone'		=> $nomor,
			'message'	=> $pesan,
		];

		curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				"Authorization: $accessKey",
			)
		);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL, "https://bdg.wablas.com/api/send-message");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		
		$result = curl_exec($curl);
		curl_close($curl);

        return $result;

        
    }

}