<?php

namespace App\Http\Controllers;

use App\Models\ItemLoan;
use App\Models\ApprovedLoan;
use App\Models\RejectedLoan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Only Unit Clerk, Unit OC, Welfare Shop Clerk, and Welfare Shop OC can access reports
        if (!Auth::user()->hasRole('Unit Clerk') && !Auth::user()->hasRole('Unit OC') && !Auth::user()->hasRole('Welfare Shop Clerk') && !Auth::user()->hasRole('Welfare Shop OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $userRole = Auth::user()->getRoleNames()->first();
        return view('reports.index', compact('userRole'));
    }

    public function itemLoanApplications()
    {
        if (!Auth::user()->hasRole('Unit Clerk') && !Auth::user()->hasRole('Unit OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $itemLoans = ItemLoan::with(['creator', 'welfare'])
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('reports.item-loans', compact('itemLoans'));
    }

    public function approvedRejectedLoans()
    {
        if (!Auth::user()->hasRole('Unit Clerk') && !Auth::user()->hasRole('Unit OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $approvedLoans = ApprovedLoan::with(['itemLoan'])
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        $rejectedLoans = RejectedLoan::with(['itemLoan'])
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return view('reports.approved-rejected', compact('approvedLoans', 'rejectedLoans'));
    }

    public function membershipDetails()
    {
        if (!Auth::user()->hasRole('Unit Clerk') && !Auth::user()->hasRole('Unit OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Get all members from item loans (unique members)
        $members = ItemLoan::select('name', 'nic', 'army_id', 'enlisted_no', 'regiment_no', 'rank', 'office_address', 'previous_unit')
            ->distinct()
            ->orderBy('name')
            ->paginate(50);

        return view('reports.membership', compact('members'));
    }

    public function guarantorDetails()
    {
        if (!Auth::user()->hasRole('Unit Clerk') && !Auth::user()->hasRole('Unit OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Get all guarantors from item loans
        $guarantors = ItemLoan::select(
            'guarantor1_name as name',
            'guarantor1_nic as nic',
            'guarantor1_army_id as army_id',
            'guarantor1_enlisted_no as enlisted_no',
            'guarantor1_regiment_no as regiment_no',
            'guarantor1_rank as rank',
            'guarantor1_office_address as office_address',
            'guarantor1_previous_unit as previous_unit'
        )
        ->whereNotNull('guarantor1_name')
        ->union(
            ItemLoan::select(
                'guarantor2_name as name',
                'guarantor2_nic as nic',
                'guarantor2_army_id as army_id',
                'guarantor2_enlisted_no as enlisted_no',
                'guarantor2_regiment_no as regiment_no',
                'guarantor2_rank as rank',
                'guarantor2_office_address as office_address',
                'guarantor2_previous_unit as previous_unit'
            )
            ->whereNotNull('guarantor2_name')
        )
        ->distinct()
        ->orderBy('name')
        ->paginate(50);

        return view('reports.guarantors', compact('guarantors'));
    }

    // Welfare Shop Clerk and Welfare Shop OC Reports
    public function welfareGuarantorDetails()
    {
        if (!Auth::user()->hasRole('Welfare Shop Clerk') && !Auth::user()->hasRole('Welfare Shop OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $user = Auth::user();
        
        // Get guarantors from item loans related to this welfare shop
        $guarantors = ItemLoan::where('welfare_id', $user->welfare_id)
            ->select(
                'guarantor1_name as name',
                'guarantor1_nic as nic',
                'guarantor1_army_id as army_id',
                'guarantor1_enlisted_no as enlisted_no',
                'guarantor1_regiment_no as regiment_no',
                'guarantor1_rank as rank',
                'guarantor1_office_address as office_address'
            )
            ->whereNotNull('guarantor1_name')
            ->union(
                ItemLoan::where('welfare_id', $user->welfare_id)
                    ->select(
                        'guarantor2_name as name',
                        'guarantor2_nic as nic',
                        'guarantor2_army_id as army_id',
                        'guarantor2_enlisted_no as enlisted_no',
                        'guarantor2_regiment_no as regiment_no',
                        'guarantor2_rank as rank',
                        'guarantor2_office_address as office_address'
                    )
                    ->whereNotNull('guarantor2_name')
            )
            ->distinct()
            ->orderBy('name')
            ->paginate(50);

        return view('reports.welfare-guarantors', compact('guarantors'));
    }

    public function welfareMembershipDetails()
    {
        if (!Auth::user()->hasRole('Welfare Shop Clerk') && !Auth::user()->hasRole('Welfare Shop OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $user = Auth::user();
        
        // Get members from item loans related to this welfare shop
        $members = ItemLoan::where('welfare_id', $user->welfare_id)
            ->select('name', 'nic', 'army_id', 'enlisted_no', 'regiment_no', 'rank', 'office_address', 'welfare_membership', 'welfare_membership_date')
            ->distinct()
            ->orderBy('name')
            ->paginate(50);

        return view('reports.welfare-membership', compact('members'));
    }

    public function welfareLoanDetails()
    {
        if (!Auth::user()->hasRole('Welfare Shop Clerk') && !Auth::user()->hasRole('Welfare Shop OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $user = Auth::user();
        
        // Get all approved loans related to this welfare shop
        $itemLoans = ApprovedLoan::where('loan_method', 'Item')
            ->whereHas('itemLoan', function($query) use ($user) {
                $query->where('welfare_id', $user->welfare_id);
            })
            ->with('itemLoan')
            ->orderBy('created_at', 'desc')
            ->get();

        $lak1Loans = ApprovedLoan::where('loan_method', 'Cash')
            ->where('loan_type', '1')
            ->with('itemLoan')
            ->orderBy('created_at', 'desc')
            ->get();

        $lak3Loans = ApprovedLoan::where('loan_method', 'Cash')
            ->where('loan_type', '3')
            ->with('itemLoan')
            ->orderBy('created_at', 'desc')
            ->get();

        $cibLoans = ApprovedLoan::where('loan_method', 'Cash')
            ->where('loan_type', 'CIB')
            ->with('itemLoan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reports.welfare-loans', compact('itemLoans', 'lak1Loans', 'lak3Loans', 'cibLoans'));
    }

    public function welfarePriceList()
    {
        if (!Auth::user()->hasRole('Welfare Shop Clerk') && !Auth::user()->hasRole('Welfare Shop OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Get all approved products with prices
        $products = \App\Models\Product::with('category')
            ->where('active', 0)
            ->orderBy('category_id')
            ->orderBy('product')
            ->paginate(50);

        return view('reports.welfare-pricelist', compact('products'));
    }

    public function loanDetailsRegimentWise()
    {
        if (!Auth::user()->hasRole('Welfare Shop Clerk') && !Auth::user()->hasRole('Welfare Shop OC')) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Get all approved loans grouped by regiment
        $loansByRegiment = ApprovedLoan::selectRaw('member_regiment_no, COUNT(*) as total_loans, SUM(total_amount) as total_amount, loan_method')
            ->groupBy('member_regiment_no', 'loan_method')
            ->orderBy('member_regiment_no')
            ->get()
            ->groupBy('member_regiment_no');

        return view('reports.loans-regiment-wise', compact('loansByRegiment'));
    }
}
