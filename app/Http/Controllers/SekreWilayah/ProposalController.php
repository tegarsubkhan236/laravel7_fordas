<?php

namespace App\Http\Controllers\SekreWilayah;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\ProposalKategori;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        $data = Proposal::all();
        return view("SekreWilayah.proposal.index",[
            "title" => "Proposal Management",
            "data" => $data,
        ]);
    }

    public function create()
    {
        $select = ProposalKategori::all();
        return view("SekreWilayah.proposal.add",[
            "title" => "Tambah Proposal Baru",
            "select" => $select,
            "route" => [
                "name" => "proposal.store",
                "params" => ""
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => "required",
            'latar_belakang' => 'required',
            'visibility' => 'required',
            'kategori_id' => 'required',
        ]);
        $data = $request->except('_token');
        $data['status'] = 0;
        $data['created_by'] = session()->get('id');
        $data["created_at"] = date("Y-m-d");
        $data["updated_at"] = date("Y-m-d");
        $store = Proposal::insert($data);

        if ($store) {
            return back()->with(["msg" => "Data berhasil disimpan !"]);
        } else {
            return back()->with(["msg" => "Data gagal disimpan !"]);
        }
    }

    public function edit($id)
    {

        $data = Proposal::where('id', $id)->first();
        $select = ProposalKategori::all();

        return view("SekreWilayah.proposal.add",[
            "title" => "Edit Proposal",
            "data" => $data,
            "select" => $select,
            "route" => [
                "name" => "proposal.store",
                "params" => ""
            ],
        ]);
    }

    public function detail($id)
    {

        $data = Proposal::where('id', $id)->first();
        $select = ProposalKategori::all();

        return view("SekreWilayah.proposal.detail",[
            "title" => "Detail Proposal",
            "data" => $data,
            "select" => $select,
        ]);
    }
}
