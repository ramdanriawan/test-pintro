<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $session = Session::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('ip_address', 'LIKE', "%$keyword%")
                ->orWhere('user_agent', 'LIKE', "%$keyword%")
                ->orWhere('payload', 'LIKE', "%$keyword%")
                ->orWhere('last_activity', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $session = Session::latest()->paginate($perPage);
        }

        return view('session.session.index', compact('session'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('session.session.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'user_id' => 'required|exists:user,id',
			'ip_address' => 'required|max:45',
			'user_agent' => 'required',
			'payload' => 'required',
			'last_activity' => 'required|integer|digits_between:1,6'
		]);
        $requestData = $request->all();
        
        Session::create($requestData);

        return redirect('session/session')->with('flash_message', 'Session added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $session = Session::findOrFail($id);

        return view('session.session.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $session = Session::findOrFail($id);

        return view('session.session.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'user_id' => 'required|exists:user,id',
			'ip_address' => 'required|max:45',
			'user_agent' => 'required',
			'payload' => 'required',
			'last_activity' => 'required|integer|digits_between:1,6'
		]);
        $requestData = $request->all();
        
        $session = Session::findOrFail($id);
        $session->update($requestData);

        return redirect('session/session')->with('flash_message', 'Session updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Session::destroy($id);

        return redirect('session/session')->with('flash_message', 'Session deleted!');
    }
}
